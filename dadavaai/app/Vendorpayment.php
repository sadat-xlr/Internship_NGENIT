<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendorpayment extends Model
{
    /**
     * Get the Order that owns the payment.
     */
    public function order()
    {
        return $this->belongsTo('App\Order');
    }
}
