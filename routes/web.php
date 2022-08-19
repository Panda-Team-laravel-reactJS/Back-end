<?php

use App\Core\Constants\SessionConstants;
use App\Http\Controllers\CustomerController;
<<<<<<< HEAD
use App\Http\Controllers\SpaStaffController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
=======
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FeedbackController;
>>>>>>> c7ef62868fb1eccac63d20d352ee057a3ce8db7e
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
<<<<<<< HEAD
    Route::prefix("/staff")->group(function () {
    Route::get("", [SpaStaffController::class, "index"])->name("staff.index");
    // Route::get("addForm", [SpaStaffController::class, "index"])->name("staff.index");
    Route::post('delete/{id}', [SpaStaffController::class, 'delete']);

        
    });
    Route::prefix("/categories")->group(function () {
        Route::get("", [CategoryController::class, "index"])->name("Categories.index");
    
            
        });
    


    
=======
    Route::get("/feedback",[ FeedbackController::class,"index"])->name("feedback.index");
    Route::prefix("/services")->group(function () {
        Route::get("", [ServiceController::class, "index"])->name("services.index");
    });
>>>>>>> c7ef62868fb1eccac63d20d352ee057a3ce8db7e
});

Route::prefix("/login")->group(function () {
    Route::get("", fn () => view("pages.login"))->name("login");
    Route::post("", [HomeController::class, "login"])->name("verifyLogin");
});

