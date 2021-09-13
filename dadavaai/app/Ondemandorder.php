<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ondemandorder extends Model
{
    /**
     * Get the order that owns the Ondemandorder.
     */
    public function order()
    {
        return $this->belongsTo('App\Order');
    }

    /**
     * Get the ondemand that owns the orderDetails.
     */
    public function ondemand()
    {
        return $this->belongsTo('App\Ondemand');
    }
}
