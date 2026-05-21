<?php

use App\Http\Controllers\User\UserPrestataireController;
use Illuminate\Support\Facades\Route;

Route::prefix('/user')->controller(UserPrestataireController::class)->group(function(){

    Route::get('/prestataire', 'index');
    Route::get('/prestataire/service/create', 'create');
    Route::get('/prestataire/service/show', 'show');
});