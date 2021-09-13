<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    /**
     * Get the customer that owns the wishlist.
     */
    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }
	
	/**
     * Get the product that owns the wishlist.
     */
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
