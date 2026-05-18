<?php

use App\Http\Controllers\LogementController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\Teams\TeamInvitationController;
use App\Http\Middleware\EnsureTeamMembership;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

Route::inertia('/', 'Welcome', [
    'canRegister' => Features::enabled(Features::registration()),
])->name('home');

// Route::prefix('{current_team}')
//     ->middleware(['auth', 'verified', EnsureTeamMembership::class])
//     ->group(function () {
//         Route::inertia('dashboard', 'Dashboard')->name('dashboard');
//     });

Route::middleware(['auth'])->group(function () {
    Route::get('invitations/{invitation}/accept', [TeamInvitationController::class, 'accept'])->name('invitations.accept');
});

Route::get("services",[ServiceController::class, 'services']);

Route::get("logement",[LogementController::class, 'logement']);

require __DIR__.'/settings.php';
require __DIR__ .'/account.php';
require __DIR__ .'/userHotel.php';

