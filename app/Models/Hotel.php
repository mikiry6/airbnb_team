<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hotel extends Model
{
    protected $guarded = ['id'];

    public function chambres():HasMany{

        return $this->hasMany(Logement::class);
    }

    public function pays():BelongsTo
    {
        return $this->belongsTo(Pays::class);
    }

    public function localisation():BelongsTo
    {
        return $this->belongsTo(Localisation::class);
    }
}
