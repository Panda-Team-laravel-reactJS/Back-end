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
    Route::get("/{id}", [ApiCustomerController::class,"getCustomer"]);
    Route::put("edit/{id}", [ApiCustomerController::class, "editCustomer"]);
});
Route::prefix("/service")->group(function(){
    Route::get("", [ApiServiceController::class,"getAll"]);
    Route::get("/{id}", [ApiServiceController::class, "getOne"]);
    Route::get("feedback", [ApiFeedbackController::class, "getAllFeedback"]);
});
Route::prefix("/staff")->group(function(){
    Route::get("", [ApiStaffController::class,"getAll"]);
    Route::get("/{id}", [ApiStaffController::class, "getOne"]);
    
});
Route::prefix("/feedback")->group(function(){
    Route::post("add",[ApiFeedbackController::class,"postFeedback"]);
    Route::get("/{id}", [ApiFeedbackController::class,"getFeedback"]);
    Route::get("booking_id/{id}", [ApiFeedbackController::class, "getFeedbackByBooking"]);
   
});