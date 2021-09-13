<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * Get the billing record associated with the order.
     */
    public function billing()
    {
        return $this->hasOne('App\Billing');
    }

    /**
     * Get the shipping record associated with the order.
     */
    public function shipping()
    {
        return $this->hasOne('App\Shipping');
    }
    /**
     * Get the client that owns the order.
     */
    public function client()
    {
        return $this->belongsTo('App\Client');
    }
    /**
     * Get the orderDetails record associated with the order.
     */
    public function orderDetails()
    {
        return $this->hasMany('App\Orderdetail');
    }

    /**
     * Get the ondemandOrder record associated with the order.
     */
    public function ondemandOrders()
    {
        return $this->hasMany('App\Ondemandorder');
    }

    /**
     * Get the payment that owns the order.
     */
    public function payment()
    {
        return $this->belongsTo('App\Payment');
    }

    /**
     * Get the traking record associated with the order.
     */
    public function tracking()
    {
        return $this->hasOne('App\Trackingdate');
    }

    /**
     * Get the serviceOrder record associated with the order.
     */
    public function serviceOrders()
    {
        return $this->hasMany('App\Serviceorder');
    }

}
