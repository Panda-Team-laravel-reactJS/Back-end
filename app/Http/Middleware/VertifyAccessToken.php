<?php

namespace App\Http\Middleware;

use App\Models\Account;
use Closure;
use Illuminate\Http\Request;

class VertifyAccessToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Account::select("access_token")->where("username", $request->username)->first();
        if ($user == null) return ["error" => "User is not found!", "status" => "fail"];
        if ($user->access_token != $request->access_token)
            return ["error" => "Access token is not correct!", "status" => "fail"];
        return $next($request); 
    }
}
