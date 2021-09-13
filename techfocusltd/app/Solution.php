<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    public function subSolutions()
    {
        return $this->hasMany('App\Subsolution');
    }
    public function products()
    {
        return $this->hasMany('App\Product');
    }

    /**
     * Get the Digital innovation record associated with the product.
     */
    public function digitalInnovations()
    {
        return $this->belongsToMany('App\Digitalinnovation');
    }

    /**
     * Get the DataCenter record associated with the product.
     */
    public function dataCenters()
    {
        return $this->belongsToMany('App\Datacenter');
    }
}
