<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ImageLogement;
use App\Models\Logement;
use App\Models\Pays;
use App\Models\Localisation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;


class UserParticulierController extends Controller
{
    public function create()
    {   
        $logement = new Logement();
        
        return Inertia::render('user/UserParticulier/UserParticulierCreate', [
            'logements' => null
        ]);
    }
    public function statShow()
    {   
        // dd('hoho');
        return Inertia::render('user/UserParticulier/UserParticulierStats');
        
    }

    public function dash()
    {
        $l = Logement::where('user_id', auth()->id())->latest()->get();
        return Inertia::render('user/UserParticulier/UserParticulierDash', [
            'logements' => $l->load('imageLogement')
        ]);
    }

    public function store(Request $request)
    {

       
    
        $request->validate([
            'type_logement' => 'required|in:cabane,chambre,appartement,bungalow,villa,autre',
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'prix' => 'required|integer',
            'nb_chambre' => 'required|integer',
            'nb_douche' => 'required|integer',
            'nb_wc' => 'required|integer',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'localisation' => 'nullable|string|max:255',
            'pays' => 'nullable|string|max:255',
            'image_principale' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'image_1' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'image_2' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'image_3' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'image_4' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);
    
        $image = [];
        $imageChamp = [
            'image_principale','image_1', 'image_2','image_3','image_4'

        ];

        foreach($imageChamp as $champ) {
           
            if ($request->hasFile($champ)){
    
                $image[$champ] = $request->file($champ)->store('image_logement', 'public');

            }
        }

        $imgPart = ImageLogement::create($image);

      
        $paysId = null;
        if ($request->filled('pays')) {
            $pays = Pays::firstOrCreate(['nom' => $request->pays]); 
            $paysId = $pays->id;
        }

        $localisationId = null;
        if ($request->filled('localisation')) {
            
            $localisation = Localisation::firstOrCreate([
                'localisation' => $request->localisation,
                'pays_id' => $paysId
            ]); 
            

            $localisationId = $localisation->id;
        }

        Logement::create([
            'user_id' => auth()->id(),
            'image_logement_id' =>$imgPart->id,
            'type_logement' => $request->type_logement,
            'titre' => $request->titre,
            'description' => $request->description,
            'prix' => $request->prix,
            'nb_chambre' => $request->nb_chambre,
            'nb_douche' => $request->nb_douche,
            'nb_wc' => $request->nb_wc,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'pays_id' => $paysId,
            'localisation_id' => $localisationId
        ]);

        
        return redirect()->route('logements.dash');
    }

    public function destroy(Logement $logement)

    {
        $logement->imageLogement->delete();
        $logement->delete();
    }


 

public function update(Request $request, Logement $logement)
{
    $request->validate([
        'type_logement' => 'required|in:cabane,chambre,appartement,bungalow,villa,autre',
        'titre' => 'required|string|max:255',
        'description' => 'required|string',
        'prix' => 'required|integer',
        'nb_chambre' => 'required|integer',
        'nb_douche' => 'required|integer',
        'nb_wc' => 'required|integer',
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
        'localisation' => 'nullable|string|max:255',
        'pays' => 'nullable|string|max:255',
        'image_principale' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        'image_1' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        'image_2' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        'image_3' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        'image_4' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
    ]);


    $imgPart = $logement->imageLogement; 
    $imageChamp = ['image_principale', 'image_1', 'image_2', 'image_3', 'image_4'];

    foreach ($imageChamp as $champ) {
        if ($request->hasFile($champ)) {
            // Supprimer l'ancienne image du stockage public si elle existe
            if ($imgPart->$champ) {
                Storage::disk('public')->delete($imgPart->$champ);
            }
            // Stocker la nouvelle image
            $imgPart->$champ = $request->file($champ)->store('image_logement', 'public');
        }
    }
    // Sauvegarder les changements dans la table image_logements
    $imgPart->save();

    // 3. Gestion du pays
    $paysId = null;
    if ($request->filled('pays')) {
        $pays = Pays::firstOrCreate(['nom' => $request->pays]); 
        $paysId = $pays->id;
    }

    // 4. Gestion de la localisation
    $localisationId = null;
    if ($request->filled('localisation')) {
        $localisation = Localisation::firstOrCreate([
            'localisation' => $request->localisation,
            'pays_id' => $paysId
        ]); 
        $localisationId = $localisation->id;
    }

    $logement->update([
        'type_logement' => $request->type_logement,
        'titre' => $request->titre,
        'description' => $request->description,
        'prix' => $request->prix,
        'nb_chambre' => $request->nb_chambre,
        'nb_douche' => $request->nb_douche,
        'nb_wc' => $request->nb_wc,
        'latitude' => $request->latitude,
        'longitude' => $request->longitude,
        'pays_id' => $paysId,
        'localisation_id' => $localisationId
    ]);

    return redirect()->route('logements.dash')->with('success', 'Logement mis à jour avec succès');
}


    public function edit(Logement $logement)
{

    $logement->load(['imageLogement', 'pays', 'localisation']);

    return Inertia::render('user/UserParticulier/UserParticulierCreate', [
          'logements' => $logement
    ]);
}

    }
