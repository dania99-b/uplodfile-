<?php
namespace App\Repository;
use App\Models\User;
use App\RepositoryInterface\UserRepositoryInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class DBUserRepository implements UserRepositoryInterface {
 private $url="http://127.0.0.1:8000/";

    public function all()
    {
        $response =Http::get($this->url,"alluser");
        $users=$response->body(get()->first()->id);
        $users=json_decode($users);
        return $users;
    }

    public function register($attribute)
    {

        $attribute['password']= bcrypt($attribute->password);
        $user = User::create($attribute->all());


        $token = $user->createToken('Laravel-9-Passport-Auth')->accessToken;

        return response()->json(['token' => $token], 200);
    }

    public function condition($attribute, $attribute2)
    {
       return User::where($attribute,$attribute2);
    }

    public function login($attribute)
    {
        $validator = Validator::make($attribute->all(),[
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        if (auth()->guard('user')->attempt(['email' => request('email'), 'password' => request('password')])) {

            config(['auth.guards.api.provider' => 'user']);

            $user = User::select('users.*')->find(auth()->guard('user')->user()->id);
            $success = $user;
            $success['token'] = $user->createToken('MyApp', ['user'])->accessToken;

            return response()->json($success, 200);
    }
}}
