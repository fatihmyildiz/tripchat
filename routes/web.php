<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PaginationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AvailabilityController;

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
 
Route::group(['middleware'=>'guest'],function(){
    Route::get('/',[AuthController::class,'login'])->name('login');
    Route::get('/register',[AuthController::class,'register'])->name('register');
    Route::get('/forget-password',[AuthController::class,'forgetPassword'])->name('forget_password');
    Route::post('/authenticate',[AuthController::class,'authenticate'])->name('authenticate');
    Route::post('/signup',[AuthController::class,'signup'])->name('signup');
});

Route::post('/logout',[AuthController::class,'logout'])->name('logout')->middleware('auth');
Route::get('/lang/{lang}',[ LanguageController::class,'switchLang'])->name('switch_lang');
Route::get('/pagination-per-page/{per_page}',[ PaginationController::class,'set_pagination_per_page'])->name('pagination_per_page');


//Sonra Kullanılacak
Route::group(['middleware'=>'guest'],function(){
    Route::get('/modlogin',[AdminAuthController::class,'login'])->name('adminlogin');
    Route::get('/adminregister',[AdminAuthController::class,'register'])->name('adminregister');
    Route::get('/adminforget-password',[AdminAuthController::class,'forgetPassword'])->name('adminforget_password');
    Route::post('/adminauthenticate',[AdminAuthController::class,'authenticate'])->name('adminauthenticate');
    Route::post('/adminsignup',[AdminAuthController::class,'signup'])->name('adminsignup');
});

Route::post('/adminlogout',[AdminAuthController::class,'logout'])->name('logout')->middleware('auth');




