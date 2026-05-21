<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AccountContrioller extends Controller
{
    public function index(){

        // dd(auth()->user()->role);
        $role =auth()->user()->role;

        if($role == 'simple'){
            return Inertia::render('user/UserDash');
        }if($role == 'hotel'){
            return Inertia::render('user/userHotel/UserHotelDash');
        }if($role == 'prestataire'){
            return Inertia::render('user/userPrestataire/UserPrestataireDash');
        }
        
    }
}
