<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class LogementController extends Controller
{
    public function logement() {
        return Inertia::render('PageLogement');
    }
}
