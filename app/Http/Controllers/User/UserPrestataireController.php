<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceFormRequest;
use App\Models\Pays;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UserPrestataireController extends Controller
{
    public function index(){

        return Inertia::render('user/userPrestataire/UserPrestataireDash');

    }

    public function create(){

        $pays= Pays::all();
        $service= new Service();

        return Inertia::render('user/userPrestataire/UserPrestataireCreate',[

            'service'=>$service,
            'pays'=>$pays
        ]);

    }

    public function store(ServiceFormRequest $request){

        // dd($request->all());

       $data = $request->validated();
       $data['user_id'] = Auth::id();

       $data['image'] = $request->file('image')->store('image_service', 'public');

        Service::create($data);

        return redirect('/user');

    }

    public function readAll(){

        $services = Service::all();


        return Inertia::render('user/userPrestataire/UserPrestataireListe',
        
            [
                'services'
            ]
        );

    }

}
