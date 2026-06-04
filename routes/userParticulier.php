<?php

use App\Http\Controllers\User\UserParticulierController;
use Illuminate\Support\Facades\Route;

Route::prefix('/user')->controller( UserParticulierController::class)->group(function(){
    // pages
    Route::get('/form', 'create')->name('logements.create');
    Route::get('/dashParticulier', 'dash')->name('logements.dash');
    Route::get('/profile', 'statShow')->name('logements.statShow');
    
    //  CRUD
    Route::post('/logements', 'store')->name('logements.store');
    Route::delete('/logements/{logement}', 'destroy')->name('logements.destroy');
    //Part modif
    Route::get('/logements/{logement}/edit', 'edit')->name('logements.edit');
    Route::put('/logements/{logement}', 'update')->name('logements.update');

});
