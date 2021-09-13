<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    /**
     * Get the product record associated with the color.
     */
    public function products()
    {
        return $this->belongsToMany('App\Product');
    }
}
