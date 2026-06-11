<?php

namespace App\Http\Controllers;

use App\Models\Pays;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Laravel\Fortify\Features;

class HomeController extends Controller
{
    public function index()
    {
        
        $pays = Pays::with('hotel')->get();
        // dd($pays);
        return Inertia::render('Welcome', [

            'pays'=>$pays,
            'canRegister' =>
                Features::enabled(
                    Features::registration()
                )

        ]);
    }

    public function logement() {
        return Inertia::render('PageLogement');
    }
}
