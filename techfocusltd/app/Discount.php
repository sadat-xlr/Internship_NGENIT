<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    /**
     * Get the client record associated with the Discount.
     */
    public function client()
    {
        return $this->belongsToMany('App\Customer');
    }
}
