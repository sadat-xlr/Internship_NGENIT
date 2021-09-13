<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    /**
     * Get the product record associated with the Technology.
     */
    public function product()
    {
        return $this->hasMany('App\Product');
    }
}
