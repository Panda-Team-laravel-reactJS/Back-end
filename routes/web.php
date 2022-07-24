<?php

use App\Core\Constants\SessionConstants;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\AdminAuth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Route for testing
Route::get("/test", function() {
    return Session(SessionConstants::ADMIN);
});
//Route for production
Route::get('/', [HomeController::class, 'index'])->name("home.index");
Route::prefix("/login")->group(function () {
    Route::get("", fn () => view("pages.login"))->name("login");
    Route::post("", [HomeController::class, "login"])->name("verifyLogin");
});
Route::prefix("/Customers")->group(function () {
    Route::get("", [CustomerController::class, "index"])->name("customers.index");
});
