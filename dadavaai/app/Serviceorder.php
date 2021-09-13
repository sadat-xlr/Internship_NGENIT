<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Serviceorder extends Model
{
    /**
     * Get the order that owns the orderDetails.
     */
    public function order()
    {
        return $this->belongsTo('App\Order');
    }
	
	/**
     * Get the product that owns the orderDetails.
     */
    public function service()
    {
        return $this->belongsTo('App\Service');
    }
}
