<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Models\Pays;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ServiceController extends Controller
{
    public function create()
    {
        $pays = Pays::all();

        return Inertia::render(
            'user/userPrestataire/UserPrestataireCreate',
            [
                'pays' => $pays
            ]
        );
    }

    public function board()
    {
        $services = Service::with('pays')
            ->latest()
            ->get();

        $totalServices = Service::count();

        $totalCountries = Service::distinct('pays_id')
            ->count('pays_id');

        $servicesThisMonth = Service::whereMonth(
            'created_at',
            now()->month
        )->count();

        $lastService = Service::latest()->first();

        return Inertia::render(
            'user/userPrestataire/UserPrestataireBoard',
            [
                'services' => $services,
                'totalServices' => $totalServices,
                'totalCountries' => $totalCountries,
                'servicesThisMonth' => $servicesThisMonth,
                'lastService' => $lastService
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

        $path = $request->file('image')
            ->store('services', 'public');

        $pays = Pays::findOrFail(
            $request->country
        );

        $latitude = null;
        $longitude = null;

        $response = Http::withHeaders([
            'User-Agent' => 'LaravelApp/1.0'
        ])->get(
            'https://nominatim.openstreetmap.org/search',
            [
                'q' => trim($pays->nom),
                'format' => 'json',
                'limit' => 1
            ]
        );

        $geo = $response->json();

        if (!empty($geo)) {

            $latitude = $geo[0]['lat'];
            $longitude = $geo[0]['lon'];
        }

        Service::create([

            'title' => $request->title,

            'description' => $request->description,

            'pays_id' => $request->country,

            'image' => $path,

            'latitude' => $latitude,

            'longitude' => $longitude,

            'user_id' => Auth::id()

        ]);

        return redirect('/prestataire/dashboard')
            ->with(
                'success',
                'Service ajouté avec succès'
            );
    }

    public function dashboard()
    {
        $services = Service::with('pays')
            ->latest()
            ->paginate(6);

        return Inertia::render(
            'user/userPrestataire/UserPrestataireDash',
            [
                'services' => $services
            ]
        );
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