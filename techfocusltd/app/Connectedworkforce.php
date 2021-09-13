<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Connectedworkforce extends Model
{
    /**
     * Get the product record associated with the deal.
     */
    public function products()
    {
        return $this->belongsToMany('App\Product');
    }

    /**
     * Get the product record associated with the deal.
     */
    public function solutions()
    {
        return $this->belongsToMany('App\Solution');
    }
}
