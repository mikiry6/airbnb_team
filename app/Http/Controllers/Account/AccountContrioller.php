<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Logement;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AccountContrioller extends Controller
{
    public function index(){

        // dd(auth()->user()->role);
        $role =auth()->user()->role;

        if($role == 'simple'){
            return Inertia::render('user/UserDash');
        }if($role == 'hotel'){

            $hotels = Hotel::all();
            $user_id = Auth::id();
            $chambres = Logement::where('user_id', "$user_id")->get();
            
            return Inertia::render('user/userHotel/UserHotelDash',[
                
                'hotels'=>$hotels,
                'chambres'=>$chambres
                
            ]);
        }if($role == 'prestataire'){
            return Inertia::render('user/userPrestataire/UserPrestataireDash');
        }
        if($role == 'particulier'){
            return Inertia::render('user/UserParticulier/UserParticulierStats');
        }
        
    }
}
