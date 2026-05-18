<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserParticulierConrtoller extends Controller
{
    public function create(){

       return Inertia::render('user/UserParticulier/UserParticulierCreate');
    }

    public function dash(){

        return Inertia::render('user/UserParticulier/UserParticulierDash');
    }
}
