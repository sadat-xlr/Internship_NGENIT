<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /**
     * Get the comare record associated with the Customer.
     */
    public function compare()
    {
        return $this->hasMany('App\Compare');
    }
	
	/**
     * Get the wishlist record associated with the Customer.
     */
    public function wishlist()
    {
        return $this->hasMany('App\Wishlist');
    }

    /**
     * Get the membership_type that owns the client.
     */
    public function membership_type()
    {
        return $this->belongsTo('App\MembershipType');
    }

    /**
     * Get the Discount record associated with the client.
     */
    public function discount()
    {
        return $this->belongsToMany('App\Discount');
    }

    /**
     * Get the order record associated with the client.
     */
    public function order()
    {
        return $this->hasMany('App\Order');
    }
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
    public function forums()
    {
        return $this->hasMany('App\Forum');
    }
}
