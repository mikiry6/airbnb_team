<?php

use App\Http\Controllers\Account\AccountContrioller;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])
    ->group(function () {

        Route::get('/user', [AccountContrioller::class, 'index'])
            ->name('dashboard');
});

