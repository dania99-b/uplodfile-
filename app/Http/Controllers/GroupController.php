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
        $this->groupRepository = $groupRepository;
    }

    public function add_group(GroupRequest $request)
    {
        $this->groupRepository->addgroup($request);
    }

    public function add_file_togroup(ADFileGroupRequest $request)
    {
        $this->groupRepository->add_fileto_group($request);
    }

    public function delete_file_fromgroup(ADFileGroupRequest $request)
    {
        $this->groupRepository->delete_filefrom_group($request);

    }


    public function add_user_togroup(ADUserGroupRequest $request)
    {
        $this->groupRepository->add_user_togroup($request);
    }

    public function delete_user_fromgroup(ADUserGroupRequest $request)
    {
        $this->groupRepository->delete_userfrom_group($request);
    }


    public function delete_GroupNoreserv_files(Request $request)
    {
        $this->groupRepository->delete_group_($request); ///////////
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

        return $this->groupRepository->show_user_group();

    }


    public function show_files_group(Request $request)
    {
return $this->groupRepository->show_file_group($request);

    }
   public function show_all_group(){
        return $this->groupRepository->show_all_group();
   }
}

