<?php

namespace App\Http\Controllers;

use App\Models\Pays;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ServiceController extends Controller
{

    public function dashboard()
    {

        $services = Service::latest()->get();

        return Inertia::render(
            'user/userPrestataire/UserPrestataireDash',
            [
                'services' => $services
            ]
        );
    }

    public function create()
    {
        $pays = Pays::all();
        return Inertia::render(
            'user/userPrestataire/UserPrestataireCreate',[
                'pays' => $pays
            ]
        );
    }

    public function store(Request $request)
    {

        $request->validate([

            
            'title' => ['required'],
            'description' => ['required'],
            'country' => ['required'],
            'image' => ['required', 'image']
        
        ]);
        // dd( $request->all());
        $path = $request->file('image')
            ->store('services', 'public');
        // dd($request->country);
        Service::create([

            'pays_id'=> $request->country,
            'title' => $request->title,
            'description' => $request->description,
            // 'country' => $request->country,
            'image' => $path,
            'user_id' => Auth::id()
        ]);

        return redirect('/prestataire/dashboard')
            ->with('success', 'Service ajouté avec succès');
    }

    public function show(int $id)
    {

        $service = Service::findOrFail($id);

        return Inertia::render(
            'user/userPrestataire/UserPrestataireShow',
            [
                'service' => $service
            ]
        );
    }

    public function edit(int $id)
    {
        $service = Service::findOrFail($id);
        $pays = Pays::all();
        // dd($service->image);
        return Inertia::render(
            'user/userPrestataire/UserPrestataireEdit',
            [
                'service' => $service,
                'pays' => $pays
            ]
        );
    }
    public function update(Request $request, int $id)
    {
        $service = Service::findOrFail($id);

        $request->validate([
            'title' => ['required'],
            'description' => ['required'],
            'country' => ['required']
        ]);

        $data = [

            'title' => $request->title,
            'description' => $request->description,
            'country' => $request->country

        ];

        if ($request->hasFile('image')) {

            // Supprimer l'ancienne image
            if ($service->image) {

                Storage::disk('public')
                    ->delete($service->image);
            }

            // Enregistrer la nouvelle image
            $path = $request->file('image')
                ->store('services', 'public');

            $data['image'] = $path;
        }

        $service->update($data);

        return redirect('/prestataire/dashboard');
    }
    // public function update(Request $request, int $id)
    // {
    //     $service = Service::findOrFail($id);

    //     $request->validate([
    //         'title' => ['required'],
    //         'description' => ['required'],
    //         'country' => ['required']
    //     ]);

    //     $data = [

    //         'title' => $request->title,

    //         'description' => $request->description,

    //         'country' => $request->country
    //     ];

    //     // dd($request->all());
    //     if ($request->image != null) {
    //         // dd('hohohohoho');
    //         if ($service->image) {
    //             Storage::disk('public')->delete($service->image);
    //         }

    //         $service->delete();
    //         $path = $request->file('image')
    //             ->store('services', 'public');

    //         $data['image'] = $path;
    //     }

    //     $service->update($data);

    //     return redirect('/prestataire/dashboard');
    // }

    public function destroy(int $id)
    {
        $service = Service::findOrFail($id);

        $service->delete();

        return redirect()->back();
    }
}