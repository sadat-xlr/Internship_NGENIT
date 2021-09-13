<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shippingaddress extends Model
{
    /**
     * Get the client that owns the shipping address.
     */
    public function client()
    {
        return $this->belongsTo('App\Client');
    }
}
