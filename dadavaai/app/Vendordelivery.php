<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendordelivery extends Model
{
    /**
     * Get the Order that owns the delivery.
     */
    public function order()
    {
        return $this->belongsTo('App\Order');
    }
}
