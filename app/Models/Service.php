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
        'user_id'
       
    ];
}