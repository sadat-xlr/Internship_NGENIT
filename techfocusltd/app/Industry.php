<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Industry extends Model
{
    /**
     * Get the product record associated with the Industry.
     */
    public function product()
    {
        return $this->hasMany('App\Product');
    }
}
