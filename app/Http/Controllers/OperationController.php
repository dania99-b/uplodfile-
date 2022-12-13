<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OperationController extends Controller
{
    function checklogin(LoginRequest $request)
    {
        $credentials = $request->validate([

            'email' => 'required|max:200|email',
            'password' => 'required |min:5',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return view('file-upload');
        }

        return back()->withErrors([
            'email' => 'The Email does not exist in our records.',
        ])->onlyInput('email');
    }

    function login(){
        return redirect('/login');
    }

    function entertoDB(RegisterRequest $request)
    {
        $user=$request->all();
        $user['password']=bcrypt($request['password']);
        User::create($user);

return redirect('/login');

    }
    function registrview()
    {
        return view('/register');
    }

    public function logout()
    {
        \auth()->logout();
        return Redirect('/');

    }

}
