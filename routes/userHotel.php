<?php

use App\Http\Controllers\Settings\ProfileController;
use App\Http\Controllers\User\UserCreateHotelController;
use App\Http\Controllers\User\UserHotelController;
use Illuminate\Support\Facades\Route;

Route::get('settings/profile', [ProfileController::class, 'edit'])->name('profile.edit');

Route::prefix('/user')->group(function(){
    
    Route::controller(UserHotelController::class)->group(function(){

       
        Route::get('/hotel/{hotel_id}/chambre/create', 'create');
        Route::post('/hotel/{hotel_id}/chambre/create', 'store');

        Route::get('/hotel/{hotel_id}/chambre/liste', 'read_all');


        Route::delete('/hotel/{chambre}/chambre/delete', 'delete');
    });

    Route::controller(UserCreateHotelController::class)->group(function(){

        Route::get('/hotel', 'index');
        Route::get('/hotel/liste', 'read_all');
        Route::get('/hotel/show/{hotel}', 'read_one');

        Route::get('/hotel/create', 'create');
        Route::post('/hotel/create', 'store');

        Route::delete('/hotel/delete/{hotel}', 'delete');
    });
    
});