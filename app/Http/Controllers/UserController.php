<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Admin;
use App\Models\User;
use App\RepositoryInterface\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public $userRepository;


    public function __construct(UserRepositoryInterface $userRepository)
  {
      $this->userRepository=$userRepository;
  }
public function store_user(RegisterRequest $request){
    $this->userRepository->register($request);

}

    public function userLogin(Request $request)
    {
        return $this->userRepository->login($request);
    }



}
