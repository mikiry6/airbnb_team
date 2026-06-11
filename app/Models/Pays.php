<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pays extends Model
{
    protected $guarded = ['id'];

    public function hotel():HasMany{

        return $this->hasMany(Hotel::class);
    }
}
