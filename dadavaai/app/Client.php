<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [ 'clientName', 'password', 'email'];


    
    /**
     * Get the points record associated with the client.
     */
    public function points()
    {
        return $this->hasMany('App\Clientpoint');
    }  

    /**
     * Get the order record associated with the client.
     */
    public function order()
    {
        return $this->hasMany('App\Order');
    }    
    
    /**
     * Get the billing record associated with the client.
     */
    public function billing()
    {
        return $this->hasOne('App\Billingaddress');
    }

    /**
     * Get the shipping record associated with the client.
     */
    public function shipping()
    {
        return $this->hasOne('App\Shippingaddress');
    }

    /**
     * Get the wishlist record associated with the Client.
     */
    public function wishlist()
    {
        return $this->hasOne('App\Wishlist');
    }

    /**
     * Get the payment record associated with the client.
     */
    public function payment()
    {
        return $this->hasOne('App\Clientpayment');
    }

    /**
     * Get the ondemands record associated with the client.
     */
    public function ondemands()
    {
        return $this->hasMany('App\Ondemand');
    }

    /**
     * Get the review associated with the client.
     */
    public function reviews()
    {
        return $this->hasMany('App\Productreview');
    }

}
