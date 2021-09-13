<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /**
     * Get the product that owns the image.
     */
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
