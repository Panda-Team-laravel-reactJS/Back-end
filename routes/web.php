<?php

use App\Core\Constants\SessionConstants;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FeedbackController;
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
    return empty(false);
});
//Route for production

Route::middleware(AdminAuth::class)->group(function() {
    Route::get('/', [HomeController::class, 'index'])->name("home.index");
    Route::get('/logout', [HomeController::class, 'logout'])->name("home.logout");
    Route::prefix("/customers")->group(function () {
        Route::get("", [CustomerController::class, "index"])->name("customers.index");
    });
    Route::get("/feedback",[ FeedbackController::class,"index"])->name("feedback.index");
    Route::prefix("/services")->group(function () {
        Route::get("", [ServiceController::class, "index"])->name("services.index");
    });
});
Route::prefix("/login")->group(function () {
    Route::get("", fn () => view("pages.login"))->name("login");
    Route::post("", [HomeController::class, "login"])->name("verifyLogin");
});

