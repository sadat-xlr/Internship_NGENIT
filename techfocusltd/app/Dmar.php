<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dmar extends Model
{
    /**
     * Get the salesman that owns the dmar.
     */
    public function salesman()
    {
        return $this->belongsTo('App\Client');
    }

    /**
     * Get the client that owns the dmar.
     */
    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    /**
     * Get the minicategory that owns the dmar.
     */
    public function minicategory()
    {
        return $this->belongsTo('App\Minicategory');
    }

    /**
     * Get the sector that owns the dmar.
     */
    public function sector()
    {
        return $this->belongsTo('App\Sector');
    }
}
