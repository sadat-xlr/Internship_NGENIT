<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Preorder extends Model
{
    /**
     * Get the payment that owns the Preorder.
     */
    public function payment()
    {
        return $this->belongsTo('App\Payment');
    }

    /**
     * Get the client that owns the order.
     */
    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    /**
     * Get the product record associated with the category.
     */
    public function preorderPayments()
    {
        return $this->hasMany('App\Preorderpayment');
    }  

    /**
     * Get the prebook that owns the Preorder.
     */
    public function prebook()
    {
        return $this->belongsTo('App\Prebook');
    }
}
