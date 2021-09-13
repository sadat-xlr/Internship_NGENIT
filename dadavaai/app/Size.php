<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    /**
     * Get the product record associated with the size.
     */
    public function products()
    {
        return $this->belongsToMany('App\Product');
    }
}
