<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\HotelFormRequest;
use App\Models\Hotel;
use App\Models\ImageLogement;
use App\Models\Localisation;
use App\Models\Logement;
use App\Models\Pays;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserCreateHotelController extends Controller
{

    public function index(){

        return Inertia::render('user/userHotel/UserHotelDash');
    }

    public function read_one(Hotel $hotel){

        
        return Inertia::render('user/userHotel/UserHotelShow',[

            'hotel'=>$hotel->load('pays', 'localisation', 'chambres')
        ]);
        
    }

    public function read_all(){

        // $hotels = Hotel::with('pays','localisation')->paginate(1);
        // // dd($hotels);
        $hotels = Hotel::all();

        return Inertia::render('user/userHotel/UserHotelListe',[

            'hotels'=> $hotels
        ]);
    }

    public function create(){

        $hotel = new Hotel();

        // -------------Set les Relations
        $hotel->setRelation('pays', new Pays());
        $hotel->setRelation('localisation', new Localisation());
        $hotel->setRelation('imageLogement', new ImageLogement());

        return Inertia::render('user/userHotel/UserHotelForm',[
            'hotel'=>$hotel
        ]);
    }

    public function store(HotelFormRequest $request){

        // dd($request->all());
        $data =  $request->validated();

        $pays = Pays::firstOrcreate([
            'pays' => $request->pays
        ]);

        $localisation = Localisation::firstOrcreate([
            'pays_id'=>$pays->id,
            'localisation'=>$request->localisation
        ]);

        // ------------------POUR ENREGISTREMENT IMAGE 
        $images = [];

        // liste des champs images
        $champsImages = [

            'image_principale',
            'image_1',
            'image_2',

        ];

        foreach ($champsImages as $champ) {

            if ($request->hasFile($champ)) {

                $images[$champ] = $request
                    ->file($champ)
                    ->store('image_logements', 'public');

                $data[$champ] = $images[$champ];

            }else{

                $images[$champ] = null;

            }
        }
        // $image_logement = ImageLogement::create($images);

        $data['user_id'] = Auth::id();
        $data['pays_id'] = $pays->id;
        $data['localisation_id'] = $localisation->id;

        Hotel::create($data);

        return redirect('/user');

    }

    public function delete( Hotel $hotel){

        // dd('en cours de suppression'.' '.$hotel);
        $images = [];
        $champsImages = [
            'image_principale',
            'image_1',
            'image_2'
        ];

        foreach ($champsImages as $champ ){
            if($hotel->$champ != null){
                // dd($hotel->$champ);
                Storage::disk('public')->delete(
                    $hotel->$champ
                );
            }
        }
        
    }

}
