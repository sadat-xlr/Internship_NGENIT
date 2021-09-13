<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * Get the orderDetails record associated with the order.
     */
    public function orderDetails()
    {
        return $this->hasMany('App\Orderdetail');
    }

    /**
     * Get the client that owns the order.
     */
    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    /**
     * Get the payment that owns the order.
     */
    public function payment()
    {
        return $this->belongsTo('App\Payment');
    }

    /**
     * Get the shipping record associated with the order.
     */
    public function shipping()
    {
        return $this->belongsTo('App\Shipping');
    }
}
