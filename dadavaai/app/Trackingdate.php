<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trackingdate extends Model
{
    /**
     * Get the order that owns the Tracking status.
     */
    public function order()
    {
        return $this->belongsTo('App\Order');
    }
}
