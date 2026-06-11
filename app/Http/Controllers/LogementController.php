<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Logement;
use Illuminate\Http\Request;
use Inertia\Inertia;


class LogementController extends Controller
{
    public function index()
    {
        // 1. Récupérer les logements (sauf les chambres)
        // Note: On charge la relation image si elle existe, adapte selon ton modèle
        $logementsReels = Logement::where('type_logement', '!=', 'chambre')->get();

        // 2. Transformer les logements pour le front
        $listeLogements = $logementsReels->map(function ($logement) {
            return [
                'id' => $logement->id,
                'nom' => $logement->titre, // On harmonise 'titre' -> 'nom'
                'description' => $logement->description,
                'type' => 'logement', // Pour que Vue sache ce que c'est
                // Gère ton image ici. Si tu as une image principale ou par défaut :
                'image' => $logement->imageLogement ? $logement->imageLogement->url : '/images/default.jpg', 
                'prix' => $logement->prix,
            ];
        });

        // 3. Récupérer les Hôtels et les transformer
        $hotels = Hotel::all();
        $listeHotels = $hotels->map(function ($hotel) {
            return [
                'id' => $hotel->id,
                'nom' => $hotel->nom,
                'description' => $hotel->description,
                'type' => 'hotel', // Pour que Vue sache ce que c'est
                'image' => $hotel->image_principale, // l'hôtel a directement cette colonne
                'prix' => null, // Un hôtel n'a pas de prix fixe (ce sont ses chambres qui en ont)
            ];
        });

        // 4. Fusionner proprement les deux collections
        $hebergementsToutEnUn = $listeLogements->concat($listeHotels);

        return Inertia::render('PageLogement', [
            'logements' => $hebergementsToutEnUn
        ]);
    }

    public function detail(Hotel $hotel){
        
        return Inertia::render('Hotel_detail',[

            'hotel'=>$hotel->load('chambres','localisation','pays')
        ]);
    }
}
