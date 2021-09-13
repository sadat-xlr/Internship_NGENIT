<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendorproduct extends Model
{
    /**
     * Get the vendor that owns the product .
     */
    public function vendor()
    {
        return $this->belongsTo('App\Vendor');
    }
}
