<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    /**
     * Get the product record associated with the deal.
     */
    public function products()
    {
        return $this->belongsToMany('App\Product');
    }
}
