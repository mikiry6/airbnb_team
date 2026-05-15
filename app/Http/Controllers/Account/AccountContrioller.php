<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AccountContrioller extends Controller
{
    public function index(){


        return Inertia::render('user/UserDash');
    }
}
