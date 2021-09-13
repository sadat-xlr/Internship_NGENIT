<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
   /**
     * Get the product that owns the cart.
     */
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
