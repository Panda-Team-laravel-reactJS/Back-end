<?php

use App\Http\Controllers\Api\ApiAccountController;
use App\Http\Controllers\Api\ApiCategoryController;
use App\Http\Controllers\Api\ApiCustomerController;
use App\Http\Controllers\Api\ApiFeedbackController;
use App\Http\Controllers\Api\ApiServiceController;
use App\Http\Controllers\Api\ApiStaffController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix("/account/")->group(function(){
    Route::post("register",[ApiAccountController::class,"register"]);
    Route::post("login",[ApiAccountController::class,"login"]);
});
Route::prefix("/categories")->group(function(){
    Route::get("", [ApiCategoryController::class,"all"]);
    Route::get("/{id}", [ApiCategoryController::class,"get"]);
});
Route::prefix("/customer")->group(function(){
    Route::get("/{id}", [ApiCustomerController::class,"get"]);
    Route::put("edit/{id}", [ApiCustomerController::class, "edit"]);
});
Route::prefix("/service")->group(function(){
    Route::get("", [ApiServiceController::class,"get"]);
    Route::get("/{id}", [ApiServiceController::class, "get"]);
    Route::get("feedback", [ApiFeedbackController::class, "all"]);
});
Route::prefix("/staff")->group(function(){
    Route::get("", [ApiStaffController::class,"all"]);
    Route::get("/{id}", [ApiStaffController::class, "get"]);
    
});
Route::prefix("/feedback")->group(function(){
    Route::post("post",[ApiFeedbackController::class,"post"]);
    Route::get("/{id}", [ApiFeedbackController::class,"get"]);
    Route::get("booking/{id}", [ApiFeedbackController::class, "getFeedbackByBooking"]);
});