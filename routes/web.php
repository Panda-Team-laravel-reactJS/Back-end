<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\AdminAuth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name("home.index");
Route::prefix("/")->group(function() {
    Route::get("login", fn() => view("pages.login"))->name("login");
    Route::post("login", [HomeController::class, "login"]);
});
Route::middleware(AdminAuth::class)->group(function() {
    Route::prefix("/Customers")->group(function() {
        Route::get("", [CustomerController::class, "index"])->name("customer.index");
    });
});
