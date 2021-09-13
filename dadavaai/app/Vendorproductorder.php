<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendorproductorder extends Model
{
    /**
     * Get the vendor that owns the order.
     */
    public function vendor()
    {
        return $this->belongsTo('App\Vendor');
    }

      /**
     * Get the product that owns the order.
     */
    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    /**
     * Get the Order that owns the order.
     */
    public function order()
    {
        return $this->belongsTo('App\Order');
    }
}
