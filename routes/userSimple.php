<?php

use App\Http\Controllers\User\UserSimpleController;
use Illuminate\Support\Facades\Route;

Route::prefix('/user')->group(function(){
    
    Route::controller(UserSimpleController::class)->group(function(){
    
        Route::get('/simple/profile', 'index');
    });
    
});