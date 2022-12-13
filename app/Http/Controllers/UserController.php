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
    DB::beginTransaction();
    try {
    $request['password']= bcrypt($request->password);
        $user = $this->userRepository->create($request->all());


        $token = $user->createToken('Laravel-9-Passport-Auth')->accessToken;
    DB::commit();
        return response()->json(['token' => $token], 200);
    } catch (\Exception $e){
    DB::rollBack();
    throw $e;}
}





    public function userDashboard()
    {
        $users =$this->userRepository->all();
        $success =  $users;

        return response()->json($success, 200);
    }

    public function adminDashboard()
    {
        $users = Admin::all();
        $success =  $users;

        return response()->json($success, 200);
    }

    public function userLogin(Request $request)
    {
        DB::beginTransaction();
        try{
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()->all()]);
        }

        if(auth()->guard('user')->attempt(['email' => request('email'), 'password' => request('password')])){

            config(['auth.guards.api.provider' => 'user']);

            $user = User::select('users.*')->find(auth()->guard('user')->user()->id);
            $success =  $user;
            $success['token'] =  $user->createToken('MyApp',['user'])->accessToken;

            return response()->json($success, 200);}}
        catch (\Exception $e){

            DB::rollBack();
       throw  $e;

        }
        return response()->json(['error' => ['Email and Password are Wrong.']], 200);
    }

    public function adminLogin(LoginRequest $request)
    {
        if($request->fails()){
            return response()->json(['error' => $request->errors()->all()]);
        }

        if(auth()->guard('admin')->attempt(['email' => request('email'), 'password' => request('password')])){

            config(['auth.guards.api.provider' => 'admin']);

            $admin = Admin::select('admins.*')->find(auth()->guard('admin')->user()->id);
            $success =  $admin;
            $success['token'] =  $admin->createToken('MyApp',['admin'])->accessToken;

            return response()->json($success, 200);
        }else{
            return response()->json(['error' => ['Email and Password are Wrong.']], 200);
        }
    }

}
