<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    /**
     * Get the product record associated with the offer.
     */
    public function products()
    {
        return $this->belongsToMany('App\Product');
    }
}
