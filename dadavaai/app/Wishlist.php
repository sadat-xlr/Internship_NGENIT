<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    /**
     * Get the client that owns the wishlist.
     */
    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    /**
     * Get the product that owns the wishlist.
     */
    public function product()
    {
        return $this->belongsTo('App\Product');
    }

}
