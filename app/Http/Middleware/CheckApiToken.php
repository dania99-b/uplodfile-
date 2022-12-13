<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckApiToken
{
    public function handle($request, Closure $next)
    {
        if(!empty(trim($request->header('Authorization'))))
        {
            $is_exists = $user= auth()->guard('user-api')->user();


            if($is_exists){

                return $next($request);
            }
        }
        return response()->json('Invalid Token', 401);
        /**
         * Handle an incoming request.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
         * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
         */

    }
}
