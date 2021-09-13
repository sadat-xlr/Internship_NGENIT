<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clientpayment extends Model
{
    /**
     * Get the client that owns the payment.
     */
    public function client()
    {
        return $this->belongsTo('App\Client');
    }
}
