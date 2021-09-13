<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ondemandproduct extends Model
{
    /**
     * Get the category that owns the product.
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    
    /**
     * Get the subcategory that owns the product.
     */
    public function subcategory()
    {
        return $this->belongsTo('App\Subcategory');
    }    

    /**
     * Get the minicategory that owns the product.
     */
    public function minicategory()
    {
        return $this->belongsTo('App\Minicategory');
    }
}
