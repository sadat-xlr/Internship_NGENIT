<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Billingaddress extends Model
{
    /**
     * Get the client that owns the billings address.
     */
    public function client()
    {
        return $this->belongsTo('App\Client');
    }
}
