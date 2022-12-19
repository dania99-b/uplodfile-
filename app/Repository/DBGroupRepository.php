<?php


namespace App\Repository;


use App\Models\File;
use App\Models\File_group;
use App\Models\Group;
use App\Models\User;
use App\Models\user_group;
use App\RepositoryInterface\GroupRepositoryInterface;

class DBGroupRepository implements GroupRepositoryInterface
{
    private $url="http://127.0.0.1:8000/";

    public function all()
    {
        return Group::all();
    }

    public function findbyID($attribute)
    {
        return Group::find($attribute);
    }

    public function exactsave()
    {
        return Group::save();
    }
    public function condition($attribute, $attribute2)
    {
        return Group::where($attribute,$attribute2);
    }

    public function addgroup($attribute)
    {
        $user = auth()->guard('user-api')->user();
        $group =Group::create($attribute->all());
    }

    public function add_fileto_group($attribute)
    {
        $user = auth()->guard('user-api')->user();

        $id_file = $attribute['id_file'];
        $id_group = $attribute['id_group'];

        $idf = File::where('id', $id_file)->get()->first()->id;

        $idg = Group::where('id', $id_group)->get()->first()->id;
        $file_owner_id = File::where('id', $id_file)->get()->first()->user_id;

        if ($idf && $idg != null )
            File_group::create([
                'file_id' => $idf,
                'group_id' => $idg

            ]);
        else return "cant add this file to this group";
    }

    public function delete_filefrom_group($attribute)
    {
        $user = auth()->guard('user-api')->user();

        $id_file = $attribute['id_file'];
        $id_group = $attribute['id_group'];
        $idfg = File_group::where('file_id', $id_file)->where('group_id', $id_group);

        $file_owner_id = File::where('id', $id_file)->get()->first()->user_id;

        if ($idfg->get()->first()->id != null )
            $idfg->delete();
        else return response()->json('cant delete file from group');
    }

    public function add_user_togroup($attribute)
    {
        $user = auth()->guard('user-api')->user();

        $id_user = $attribute['id_user'];
        $id_group = $attribute['id_group'];
        $idu = User::where('id', $id_user)->get()->first()->id;
        $idg = Group::where('id', $id_group)->get()->first()->id;
        $group_owner_id = Group::where('id', $idg)->get()->first()->user_id;

        if ($idu && $idg != null && $group_owner_id == $user->id)
            user_group::create([
                'user_id' => $idu,
                'group_id' => $idg

            ]);
        else return response()->json("cant add this user to this group");
    }

    public function delete_userfrom_group($attribute)
    {
        $user = auth()->guard('user-api')->user();

        $id_user = $attribute['id_user'];
        $id_group = $attribute['id_group'];
        $group_owner_id = Group::where('id', $id_group)->get()->first()->user_id;

        $user_group = User_group::where('user_id', $id_user)->where('group_id', $id_group);

        $checkifreservfiles = File_group::where('user_group_id', $user_group->get()->first()->id)->get()->first();

        if ($checkifreservfiles==null )
        {

            $user_group->delete();

       }
        else return response()->json('can not delete this user from group',400);

    }

    public function delete_group_($attribute)
    {         $count=0;
        $user = auth()->guard('user-api')->user();

        $group_id = $attribute['id_group'];
        $curr_group =Group::where('id', $group_id)->get();

        //////for loop in all files inside group
        $group_have_files = File_group::where('group_id', $group_id)->get();

        foreach ($group_have_files as $group) {
            if ($group->user_group_id == 0)
                          $count=0;
            else $count++;
        }

            if($count==0) {
                 $curr_group->delete(); //////////
          File_group::where('group_id', $group_id)->get()->delete();
                User_group::where('group_id', $group_id)->delete();
                dd('deleted successfully');
            }

             else {dd('can not delete this group');  }

    }

    public function show_user_group()
    {
         $user = auth()->guard('user-api')->user();
           $groups = Group::where('user_id', $user->id)->get();
              return response()->json($groups);
    }

    public function show_file_group($attribute)
    {
   $user = auth()->guard('user-api')->user();
        $id= $attribute['id'];

            $file_id=File_group::where('group_id',$id)->get()->pluck('file_id');

            for($x=0;$x<count($file_id);$x++)

$file[] = File::where('id',$file_id[$x])->get();
            return  $file; }

    public function show_all_group()
    {
       $groups=Group::all();
       return $groups;
    }
}
