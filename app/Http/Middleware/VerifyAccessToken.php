<?php

namespace App\Http\Middleware;

use App\Models\Account;
use Closure;
use Illuminate\Http\Request;

class VerifyAccessToken
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
        $user = Account::select(["access_token", "customer_id"])->where("username", $request->username)->first();
        if ($user == null) return response()->json(["errors" => ["user" => "User is not found!"], "status" => false]);
        if ($user->access_token != $request->accessToken)
            return response()->json(["errors" => ["accessToken" => "Access token is not correct!"], "status" => false]);
        $request->customerId = $user->customer_id;
        return $next($request); 
    }
}
