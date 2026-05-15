<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class ServiceController extends Controller
{
    public function services() {
        return Inertia::render('PageServices');
    }
}
