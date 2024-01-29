<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

/************************ Dashboard Routes Start ******************************/
Route::group(['middleware'=>'auth'],function(){
    Route::group(['prefix'=>'{language}'],function(){
        Route::group(['prefix'=>'dashboards','as'=>'dashboard.'],function(){

            Route::middleware(['ModRole'])->group(function () {
            Route::get('mod-homepage',[DashboardController::class,'index'])->name('mod_homepage');
            });

            Route::middleware(['AdminRole'])->group(function () {
            Route::get('admin-homepage',[DashboardController::class,'homepage'])->name('admin_homepage');
            });

        });
    });    
});
/************************ Dashboard Routes Ends ******************************/