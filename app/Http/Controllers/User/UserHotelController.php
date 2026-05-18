<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserHotelController extends Controller
{
    public function index(){

        return Inertia::render('user/userHotel/UserHotelDash');
    }

    public function create(){

        return Inertia::render('user/userHotel/UserHotelCreate');
    }   

    public function show(){

        return Inertia::render('user/userHotel/UserHotelShow');
    }

}
