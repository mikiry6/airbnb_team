<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Logement extends Model
{
    protected $guarded = ['id'];

    public function pays():BelongsTo
    {
        return $this->belongsTo(Pays::class);
    }

    public function localisation():BelongsTo
    {
        return $this->belongsTo(localisation::class);
    }

    public function imageLogement():BelongsTo
    {
        return $this->belongsTo(ImageLogement::class);
    }

}
