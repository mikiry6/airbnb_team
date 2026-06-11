<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogementController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\Teams\TeamInvitationController;
use App\Http\Middleware\EnsureTeamMembership;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Inertia\Inertia;


Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/logement',[LogementController::class, 'index'])
    ->name('logement');
Route::get('/logement/hotel/detail/{hotel}',[LogementController::class, 'detail']);
Route::get('/logement/maison/detail/{logement}',[LogementController::class, 'detail']);


Route::get('/service',[ServiceController::class, 'services']);

// ---------------------------------------------------------------------------
Route::middleware(['auth'])->group(function () {
    Route::get('invitations/{invitation}/accept', [TeamInvitationController::class, 'accept'])->name('invitations.accept');
});


Route::get('/contact', function () {
    return view('contact');
});

Route::get('/about', function () {
    return Inertia::render('About/AboutView');
});

Route::get("services",[ServiceController::class, 'services']);

Route::get("logement",[LogementController::class, 'logement']);

require __DIR__.'/settings.php';
require __DIR__ .'/account.php';
require __DIR__ .'/userHotel.php';
require __DIR__ .'/userPrestataire.php';

