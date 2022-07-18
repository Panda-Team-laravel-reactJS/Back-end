<?php

use App\Http\Controllers\Api\ApiAccountController;
use App\Http\Controllers\Api\ApiCategoryController;

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
