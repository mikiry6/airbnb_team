<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChambreFormRequest;
use App\Models\ImageLogement;
use App\Models\Localisation;
use App\Models\Logement;
use App\Models\Pays;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Inertia\Inertia;

class UserHotelController extends Controller
{

    public function create($hotel_id){

        $logement = new Logement();
        // -------------Set les Relations
        // $logement->setRelation('pays', new Pays());
        // $logement->setRelation('localisation', new Localisation());
        // $logement->setRelation('imageLogement', new ImageLogement());

        return Inertia::render('user/userHotel/UserHotelChambreForm',[
            
            'logement'=>$logement,
            'hotel_id'=>$hotel_id
        ]);
    }   

    public function store(ChambreFormRequest $request , $hotel_id){

        // dd($request->all());
        // $pays = Pays::firstOrcreate([
        //     'pays' => $request->pays
        // ]);

        // $localisation = Localisation::firstOrcreate([
        //     'pays_id'=>$pays->id,
        //     'localisation'=>$request->localisation
        // ]);

        // ------------------POUR ENREGISTREMENT IMAGE 
        $images = [];

        // liste des champs images
        $champsImages = [

            'image_principale',
            'image_1',
            'image_2',
            'image_3'
        ];

        foreach ($champsImages as $champ) {

            if ($request->hasFile($champ)) {

                $images[$champ] = $request
                    ->file($champ)
                    ->store('image_logements', 'public');

            }else{

                $images[$champ] = null;

            }
        }
        $image_logement = ImageLogement::create($images);

        // dd($pays->id);
        $data =  $request->validated();

        $data['user_id'] = Auth::id();
        $data['hotel_id'] = $hotel_id;
        $data['image_logement_id'] = $image_logement->id;

        Logement::create($data);

        return redirect('/user');

    }

    public function read_all($hotel_id){

        $chambres = Logement::where('hotel_id', $hotel_id)->with('imageLogement')->get();

        return Inertia::render('user/userHotel/UserHotelChambreListe',[

            'chambres'=>$chambres

        ]);
    }
    
    public function delete( Logement $chambre){

        $chambre->imageLogement->delete();
        $chambre->delete();
    }
}
