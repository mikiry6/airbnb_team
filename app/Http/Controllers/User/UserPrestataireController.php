<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserPrestataireController extends Controller
{
    public function index(){

        return Inertia::render('user/userPrestataire/UserPrestataireDash');
    }

    public function create(){

        return Inertia::render('user/userPrestataire/UserPrestataireCreate');
    }   

    public function show(){

        return Inertia::render('user/userPrestataire/UserPrestataireShow');
    }
}
