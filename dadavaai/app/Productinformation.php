<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productinformation extends Model
{
	/**
     * Get the product that owns the Productinformation.
     */
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
