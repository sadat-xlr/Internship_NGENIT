<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productreview extends Model
{
    /**
     * Get the product that owns the review.
     */
    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    /**
     * Get the client that owns the review.
    */
    public function client()
    {
        return $this->belongsTo('App\Client');
    }
}
