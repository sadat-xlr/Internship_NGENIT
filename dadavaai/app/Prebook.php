<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prebook extends Model
{
    /**
     * Get the product that owns the prebook.
     */
    public function product()
    {
        return $this->belongsTo('App\Product');
    }

}
