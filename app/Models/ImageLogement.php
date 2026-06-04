<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Override;

class ImageLogement extends Model
{
    protected $guarded = ['id'];

    
    protected static function booted()
    {
        static::deleting(function ($imageLogement) {
            $images = [
                'image_principale',
                'image_1',
                'image_2',
                'image_3',
                'image_4',
            ];

            foreach ($images as $image ) {

                if ($imageLogement->$image) {
                    Storage::disk('public')->delete(
                        $imageLogement->$image
                    );
                }
            }
        });
    }
}
