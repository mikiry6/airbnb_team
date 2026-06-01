<?php

use App\Http\Controllers\LogementController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\Teams\TeamInvitationController;
use App\Http\Middleware\EnsureTeamMembership;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Inertia\Inertia;

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

<<<<<<< HEAD
Route::get('/contact', function () {
    return view('contact');
});

Route::get('/about', function () {
    return Inertia::render('About/AboutView');
});
=======
Route::get("services",[ServiceController::class, 'services']);

Route::get("logement",[LogementController::class, 'logement']);
>>>>>>> 965f68eb296c7d9ef439ea3634361780714a0e9c

require __DIR__.'/settings.php';
require __DIR__ .'/account.php';
require __DIR__ .'/userHotel.php';
require __DIR__ .'/userPrestataire.php';

