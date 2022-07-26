<?php

use App\Http\Controllers\Api\ApiAccountController;
use App\Http\Controllers\Api\ApiBookingController;
use App\Http\Controllers\Api\ApiCategoryController;
use App\Http\Controllers\Api\ApiCustomerController;
use App\Http\Controllers\Api\ApiFeedbackController;
use App\Http\Controllers\Api\ApiServiceController;
use App\Http\Controllers\Api\ApiStaffController;
use App\Http\Middleware\ApiCORS;
use App\Http\Middleware\VerifyAccessToken;
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

Route::middleware(ApiCORS::class)->group(function () {
    Route::prefix("/account/")->group(function () {
        Route::post("register", [ApiAccountController::class, "register"]);
        Route::post("login", [ApiAccountController::class, "login"]);
        Route::post("reset-password", [ApiAccountController::class, "resetPassword"]);
    });
    Route::prefix("/categories/")->group(function () {
        Route::get("", [ApiCategoryController::class, "all"])->name("categories.index");
        Route::get("{id}", [ApiCategoryController::class, "get"]);
    });
    Route::prefix("/customer/")->middleware(VerifyAccessToken::class)->group(function () {
        Route::post("info", [ApiCustomerController::class, "getInfo"]);
        Route::post("edit", [ApiCustomerController::class, "edit"]);
    });
    Route::prefix("/service/")->group(function () {
        Route::get("", [ApiServiceController::class, "all"]);
        Route::get("{id}", [ApiServiceController::class, "get"]);
        Route::get("feedback", [ApiFeedbackController::class, "all"]);
    });
    Route::prefix("/staff/")->group(function () {
        Route::get("", [ApiStaffController::class, "all"]);
        Route::get("{id}", [ApiStaffController::class, "get"]);
    });
    Route::prefix("/feedback/")->group(function () {
        Route::post("post", [ApiFeedbackController::class, "post"]);
        Route::get("{id}", [ApiFeedbackController::class, "get"]);
        Route::get("booking/{id}", [ApiFeedbackController::class, "getFeedbackByBooking"]);
    });
    Route::post("/booking", [ApiBookingController::class, "book"])->middleware(VerifyAccessToken::class);
});
