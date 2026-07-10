<?php


use App\Http\Controllers\User\UserPrestataireController;
use Illuminate\Support\Facades\Route;

Route::prefix('/user')->controller(UserPrestataireController::class)->group(function(){

    Route::get('/prestataire', 'index');

    Route::get('/prestataire/services/create', 'create');
    Route::post('/prestataire/services/store', 'store');

    Route::get('/prestataire/services/liste', 'readAll');
  
});