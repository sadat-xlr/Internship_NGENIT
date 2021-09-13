<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    /**
     * Get the ondemand/ RFQS that owns this quotation
     */
    public function ondemand()
    {
        return $this->belongsTo('App\Ondemand');
    }

    /**
     * Get the vendor that owns this quotation
     */
    public function vendor()
    {
        return $this->belongsTo('App\Vendor');
    }

}
