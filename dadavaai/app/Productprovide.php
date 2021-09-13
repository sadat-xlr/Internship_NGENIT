<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productprovide extends Model
{
    /**
     * Get the vendor that owns the product provide info.
     */
    public function vendor()
    {
        return $this->belongsTo('App\Vendor');
    }

       /**
     * Get the category that owns the Productprovide.
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    
    /**
     * Get the subcategory that owns the Productprovide.
     */
    public function subcategory()
    {
        return $this->belongsTo('App\Subcategory');
    }    

    /**
     * Get the minicategory that owns the Productprovide.
     */
    public function minicategory()
    {
        return $this->belongsTo('App\Minicategory');
    }
}
