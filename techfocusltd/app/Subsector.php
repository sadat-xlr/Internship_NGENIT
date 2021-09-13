<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subsector extends Model
{
    /**
     * Get the sector that owns the subsector.
     */
    public function sector()
    {
        return $this->belongsTo('App\Sector');
    }
}
