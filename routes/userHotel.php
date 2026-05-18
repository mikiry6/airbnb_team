<?php

use App\Http\Controllers\User\UserHotelController;
use Illuminate\Support\Facades\Route;

Route::prefix('/user')->controller(UserHotelController::class)->group(function(){

    Route::get('/hotel', 'index');
    Route::get('/hotel/chambre/create', 'create');
    Route::get('/hotel/chambre/show', 'show');
});