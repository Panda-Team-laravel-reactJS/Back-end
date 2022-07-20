<?php

namespace App\Http\Middleware;

use App\Models\Account;
use Closure;
use DateTimeZone;
use Illuminate\Http\Request;

class VertifyOTP
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
        $otp = Account::select("OTP", "OTP_expired")->where("username", $request->username)->first();
        if ($otp == null) return ["error" => "User is not found!", "status" => "fail"];
        
        $now = date_create("now", new DateTimeZone("Asia/Ho_Chi_Minh"))->getTimestamp();
        $otpExpired = date_create($otp->OTP_expired)->getTimestamp();
        if ($now > $otpExpired) return ["error" => "OTP has expired!", "status" => "fail"];
        if ($otp->OTP != $request->OTP)
            return ["error" => "OTP is wrong!", "status" => "fail"];
        return $next($request); 
    }
}
