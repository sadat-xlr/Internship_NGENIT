<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    /**
     * Get the subsector record associated with the sector.
     */
    public function subsector()
    {
        return $this->hasMany('App\Subsector');
    }
}
