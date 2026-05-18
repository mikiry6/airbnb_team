<?php

use App\Http\Controllers\User\UserParticulierConrtoller;
use Illuminate\Support\Facades\Route;

Route::prefix('/user')->controller(UserParticulierConrtoller::class)->group(function(){

    Route::get('/form', 'create');
    Route::get('/dashParticulier', 'dash');
    
});