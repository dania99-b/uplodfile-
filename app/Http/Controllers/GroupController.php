<?php

namespace App\Http\Controllers;

use App\Http\Requests\ADFileGroupRequest;
use App\Http\Requests\ADUserGroupRequest;
use App\Http\Requests\FileRequest;
use App\Http\Requests\GroupRequest;
use App\Models\File;
use App\Models\File_group;
use App\Models\Group;
use App\Models\User;
use App\Models\user_group;
use App\RepositoryInterface\GroupRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    private $groupRepository;
    public function __construct(GroupRepositoryInterface $groupRepository)
    {
        $this->groupRepository=$groupRepository;
    }
    public function add_group(Request $request)
    {
        $user = auth()->guard('user-api')->user();
        $group =$this->groupRepository->create($request->all());

    }

    public function add_file_togroup(ADFileGroupRequest $request)
    {
        $user = auth()->guard('user-api')->user();

        $id_file = $request['id_file'];
        $id_group = $request['id_group'];
        $idf = File::where('id', $id_file)->get()->first()->id;
        $idg = Group::where('id', $id_group)->get()->first()->id;
        $file_owner_id = File::where('id', $id_file)->get()->first()->user_id;

        if ($idf && $idg != null && $file_owner_id == $user->id)
            File_group::create([
                'file_id' => $idf,
                'group_id' => $idg

            ]);
        else return "cant add this file to this group";
    }

    public function delete_file_fromgroup(ADFileGroupRequest $request)
    {
        $user = auth()->guard('user-api')->user();

        $id_file = $request['id_file'];
        $id_group = $request['id_group'];
        $idfg = File_group::where('file_id', $id_file)->where('group_id', $id_group);

        $file_owner_id = File::where('id', $id_file)->get()->first()->user_id;

        if ($idfg->get()->first()->id != null && $file_owner_id == $user->id)
            $idfg->delete();
        else return response()->json('cant delete file from group');
    }


    public function add_user_togroup(ADUserGroupRequest $request)
    {
        $user = auth()->guard('user-api')->user();

        $id_user = $request['id_user'];
        $id_group = $request['id_group'];
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

    public function delete_user_fromgroup(ADUserGroupRequest $request)
    {
        $user = auth()->guard('user-api')->user();

        $id_user = $request['id_user'];
        $id_group = $request['id_group'];
        $group_owner_id = Group::where('id', $id_group)->get()->first()->user_id;
        $user_group = User_group::where('user_id', $id_user)->where('group_id', $id_group);
        $checkifreservfiles = File_group::where('user_group_id', $user_group->get()->first()->id)->get();

        if ($checkifreservfiles->first() == null && $group_owner_id == $user->id && $id_user != $group_owner_id)

            $user_group->delete();
        else return response()->json('can not delete this user from group');

    }


    public function delete_GroupNoreserv_files(Request $request)
    {
        $user = auth()->guard('user-api')->user();

        $group_id = $request['id_group'];
        $curr_group = Group::where('id', $group_id);
        //////for loop in all files inside group
        $group_have_files = File_group::where('group_id', $group_id)->get();

        foreach ($group_have_files as $group) {
            if ($group->user_group_id == 0 && $user->id == $curr_group->get()->first()->user_id) {

                $curr_group->delete();
                File_group::where('group_id', $group_id)->delete();
                User_group::where('group_id', $group_id)->delete();
            } else return response()->json('can not delete this group');
        }

    }


    public function add_public_group(Request $request)
    {
        $group = Group::create([
            'name' => "Public",
            'user_id' => 0

        ]);
    }

    public function show_user_group()
    {

        $user = auth()->guard('user-api')->user();
        $groups = Group::where('user_id', $user->id)->get();
        return response()->json($groups);

    }


    public function show_files_group()
    {

        $user = auth()->guard('user-api')->user();
        $group_id = DB::table('groups')->pluck('id');
        for ($i = 0; $i < count($group_id); $i++) {
            $file_id = File_group::where('group_id', $group_id[$i])->pluck('file_id');
            for ($j = 0; $j < count($file_id); $j++) {
                $files[] =File::where('id', $file_id[$j])->get();
            }}
            return response()->json( $files);


        }
    }

