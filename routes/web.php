<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\HotelChambreLogementController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\Teams\TeamInvitationController;
use App\Http\Middleware\EnsureTeamMembership;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Inertia\Inertia;


Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/logement',[HotelChambreLogementController::class, 'index'])
    ->name('logement');


Route::get('/logement/hotel/detail/{hotel}',[HotelChambreLogementController::class, 'detail']);
Route::get('/logement/hotel/chambre/liste/{hotel}',[HotelChambreLogementController::class, 'liste_chambre']);

Route::get('/logement/maison/detail/{logement}',[HotelChambreLogementController::class, 'detail']);


// ---------------------------------------------------------------------------
Route::middleware(['auth'])->group(function () {
    Route::get('invitations/{invitation}/accept', [TeamInvitationController::class, 'accept'])->name('invitations.accept');
});


require __DIR__.'/settings.php';
require __DIR__ .'/account.php';
require __DIR__ .'/userHotel.php';
require __DIR__ .'/userPrestataire.php';
require __DIR__ .'/userParticulier.php';
