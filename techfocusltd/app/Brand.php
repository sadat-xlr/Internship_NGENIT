<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    /**
     * Get the product record associated with the brand.
     */
    public function product()
    {
        return $this->hasMany('App\Product');
    }
}
