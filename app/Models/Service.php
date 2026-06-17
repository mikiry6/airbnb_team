<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [

        'title',
        'description',
        'pays_id',
        'image',
        'latitude',
        'longitude',
        'user_id'
    ];

    public function pays()
    {
        return $this->belongsTo(Pays::class);
    }
}