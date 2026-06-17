<?php

use App\Http\Controllers\ServiceController;
use App\Http\Controllers\User\UserPrestataireController;
use Illuminate\Support\Facades\Route;

// Route::prefix('/user')->controller(UserPrestataireController::class)->group(function(){

//     Route::get('/prestataire', 'index');
//     Route::get('/prestataire/service/create', 'create');
//     Route::get('/prestataire/service/show', 'show');
// });

Route::controller(ServiceController::class)
    ->group(function () {


        Route::get(
            '/prestataire/tableau-de-board',
            'board'
        );
        
        // DASHBOARD
        Route::get(
            '/prestataire/dashboard',
            'dashboard'
        );
        

        // CREATE
        Route::get(
            '/prestataire/services/create',
            'create'
        );

        // STORE
        Route::post(
            '/services/store',
            'store'
        );

        // SHOW
        Route::get(
            '/services/{id}',
            'show'
        );

        Route::get(
            '/prestataire/services/{id}/edit',
            'edit'
        );

        Route::put(
            '/services/{id}',
            'update'
        );

        Route::delete(
            '/services/{id}',
            'destroy'
        );

    });