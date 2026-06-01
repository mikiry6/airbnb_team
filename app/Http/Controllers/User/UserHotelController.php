<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\HotelFormRequest;
use App\Http\Requests\ImageLogementRequest;
use App\Models\Logement;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserHotelController extends Controller
{
    public function index(){

        $logement = new Logement();
        // dd($logement);
        return Inertia::render('user/userHotel/UserHotelDash',[

            'logement'=>$logement
        ]);
    }

    public function create(  ){

        return Inertia::render('user/userHotel/UserHotelCreate');
    }   

    public function store(Request $request){

        dd($request->all());
    }

    public function show(){

        return Inertia::render('user/userHotel/UserHotelShow');
    }

}
