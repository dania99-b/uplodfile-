<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\Models\File;
use App\Models\File_group;
use App\Models\Report;
use App\Models\User;
use App\Models\user_group;
use App\RepositoryInterface\FileRepositoryInterface;
use App\RepositoryInterface\UserRepositoryInterface;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{
private $fileRepository;
    public function __construct(FileRepositoryInterface $fileRepository)
    {
        $this->fileRepository=$fileRepository;
    }

        public function storee(Request $request)
        {
            // $user = $request -> user() ;
            if(!$request->file('filename')) {
                return response()->json(['upload_file_not_found'], 400);

            }

            $allowedfileExtension=['txt','docx','pdf','jpg','png'];
            $files = $request->file('filename');

                $extension = $files->getClientOriginalExtension();

                $check = in_array($extension,$allowedfileExtension);

                if($check) {

                        $name = $request->filename->getClientOriginalName();
                    $path = $request->filename->store('public/images');
                        //store image file into directory and db
                        $save = new File();

                    $user= auth()->guard('user-api')->user();
                    $user_name=User::where('id',$user->id)->get()->first()->first_name;
                        $save->user_id=$user->id;
                        $save->path = $path;
                        $save->name = $name;
                        $save->status = "free";
                        $save->save();

                        $date=Carbon::now();

                    $report= new Report();
                    $report->file_id=$save->id;
                    $report->operation_name = "create file";
                    $report->operation_date= $date;
                    $report->username= $user_name;
                    $report->save();

                } else {
                    return response()->json(['invalid_file_format'], 422);
                }

                return response()->json(['file_uploaded'], 200);

            }

    public function delete_file(Request $request)

    {
        $user= auth()->guard('user-api')->user();
$id=$request['id'];
$file=File::find($id);
if($file->status=="free")
    $file->delete();


        }

    public function uploaded_file(){
        $user= auth()->guard('user-api')->user();
        $files= $this->fileRepository->condition('user_id',$user->id)->get();
        Cache::put('files',$files,120);
    return response()->json($files);


    }
    public function cache_file(){

$posts = Cache::get('files');
        return $posts;}

    public function show_usersname_reserv_file(Request $request)
    {

        $file_id = $request['file_id'];
        $file = $this->fileRepository->condition('id', $file_id)->get();
        if ($file->first()->status != "free") {

            $filee = File_group::where('file_id', $file_id)->get();
            $reserv_id = $filee->first()->user_group_id;

            $user_id = User_group::where('id', $reserv_id)->get()->first()->user_id;
          if($user_id)
            $user_idd = $user_id;
        } else
            $user_idd = $file->reserved_by;
        $user_name = User::where('id', $user_idd)->get()->first()->first_name;
        return $user_name;

        return "its still free";
    }

function read_file(Request $request)
{


    $files = Storage::disk('public')->files('images');

//    foreach ($files as $file) {
//        $contents = Storage::disk('public')->get($file);
//        $slice = preg_split("/\\r\\n|\\r|\\n/", $contents);
//
//        $content[] = [
//            '3dd'=>count($files),
//
//            'metadata' => $slice[0],
//            'data1' => $slice[1],
//            'data2' => $slice[2],
//            'data3' => $slice[3],
//        ];
// $co= mb_convert_encoding($content, 'UTF-8', 'UTF-8');
//        return response()->json($co);
//
    $user= auth()->guard('user-api')->user();
$id=$request['id'];
   $file= $this->fileRepository->findbyID($id);
    $file_group = File_group::where('file_id', $id)->get()->pluck('user_group_id');
    foreach ($file_group as $user_group_ids){
        if($user_group_ids!=0)
    $user_group_id=user_group::find($user_group_ids);

        if($file->status=="free"){
        $path=$file->path;
        $download=Storage::download($path);

        return response()->json([
            'message'=>'the file is successfully read',
            'file'=>$download,
        ],200);
    }

   else if(($file->status=="reserved")&&($user->id==$user_group_id->user_id)){
    $path=$file->path;
    $download=Storage::download($path);

    return response()->json([
        'message'=>'the file is successfully read',
        'file'=>$download,
    ],200);
}
        return response()->json([
            'message'=>'cant open this file'
        ]);

    }}
function checkin_file(Request $request){
    $user= auth()->guard('user-api')->user();
    $user_name=User::where('id',$user->id)->get()->first()->first_name;
    $id=$request['id'];
    $file= $this->fileRepository->findbyID($id);
    if($file&& $file->status=="free") {
        $file->status = 'reserved';
        $file->reserved_by=$user->id;
        $file->save();

        $date=Carbon::now();

        $report= new Report();
        $report->file_id=$file->id;
        $report->operation_name = "reservation file";
        $report->operation_date= $date;
        $report->username= $user_name;
        $report->save();
        $user_group = user_group::where('user_id', $user->id)->get()->first()->id;
        $file_group = File_group::where('file_id', $id)->first();

        if ($file_group) {
            $file_group->user_group_id = $user_group;
            $file_group->save();

        }

    }}

    function checkout_file(Request $request){
        $user= auth()->guard('user-api')->user();
        $user_name=User::where('id',$user->id)->get()->first()->first_name;
        $id=$request['id'];
        $file=$this->fileRepository->findbyID($id);
        if($file&& $file->status=="reserved"&&$file->reserved_by==$user->id) {
            $file->status = 'free';
            $file->reserved_by=0;
            $file->save();

            $date=Carbon::now();

            $report= new Report();
            $report->file_id=$file->id;
            $report->operation_name = "cancel reservation file";
            $report->operation_date= $date;
            $report->username= $user_name;
            $report->save();
            $user_group = user_group::where('user_id', $user->id)->get()->first()->id;
            $file_group = File_group::where('file_id', $id)->first();

            if ($file_group&& $user_group) {
                $file_group->user_group_id =0;
                $file_group->save();

            }

        }else return "cant check out this file";

       /* function bulkcheckin(Request $request){
        $files_id[]=$request->input('files_id');
            $user= auth()->guard('user-api')->user();
            $user_name=User::where('id',$user->id)->get()->first()->first_name;
            for ($x=0;$x<count($files_id);$x++){
            $file= $this->fileRepository->findbyID($files_id[$x]);
            if($file&& $file->status=="free") {
                $file->status = 'reserved';
                $file->reserved_by=$user->id;
                $file->save();

                $date=Carbon::now();

                $report= new Report();
                $report->file_id=$file->id;
                $report->operation_name = "reservation file";
                $report->operation_date= $date;
                $report->username= $user_name;
                $report->save();
                $user_group = user_group::where('user_id', $user->id)->get()->first()->id;
                $file_group = File_group::where('file_id', $id)->first();

                if ($file_group) {
                    $file_group->user_group_id = $user_group;
                    $file_group->save();

                }

            }*/
    }
    function update_file(Request $request){
        $user= auth()->guard('user-api')->user();
        $user_name=User::where('id',$user->id)->get()->first()->first_name;
        $id = $request['id'];
        $file = File::find($id);
        $user = auth()->guard('user-api')->user();


        $allowedfileExtension=['txt','docx','pdf','jpg','png'];
        $files = $request->file('filename');

        $extension = $files->getClientOriginalExtension();

        $check = in_array($extension,$allowedfileExtension);

        if($check) {

            $path = $request->filename->store('public/images');
            $name = $request->filename->getClientOriginalName();

            $file->path = $path;
            $file->name = $name;
            $file->save();

        }
        else {
            return response()->json(['invalid_file_format'], 422);
        }

        $date = Carbon::now();
        $report= new Report();
        $report->file_id=$file->id;
        $report->operation_name = "update";
        $report->operation_date= $date;
        $report->username= $user_name;
        $report->save();

        return response()->json(['file updated'], 200);

    }
    public function show_all_file(){
        $file=File::all();
        return $file;
    }

}
