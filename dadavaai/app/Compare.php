<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compare extends Model
{

	/**
     * Get the product that owns the compare.
     */
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
    
}
