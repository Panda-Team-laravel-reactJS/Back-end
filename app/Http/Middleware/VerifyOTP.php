<?php

namespace App\Http\Middleware;

use App\Models\Account;
use Closure;
use DateTimeZone;
use Illuminate\Http\Request;

class VerifyOTP
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
        if ($otp == null) return response()->json(["error" => "User is not found!", "status" => false]);
        
        $now = date_create("now", new DateTimeZone("Asia/Ho_Chi_Minh"))->getTimestamp();
        $otpExpired = date_create($otp->OTP_expired)->getTimestamp();
        if ($now > $otpExpired) return response()->json(["error" => "OTP has expired!", "status" => false]);
        if ($otp->OTP != $request->OTP)
            return response()->json(["error" => "OTP is wrong!", "status" => "fail"]);
        return $next($request); 
    }
}
