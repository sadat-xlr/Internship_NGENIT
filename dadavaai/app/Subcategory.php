<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    /**
     * Get the category that owns the subcategory.
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    /**
     * Get the minicategory record associated with the subcategory.
     */
    public function minicategory()
    {
        return $this->hasMany('App\Minicategory');
    }

    /**
     * Get the product record associated with the Subcategory.
     */
    public function product()
    {
        return $this->hasMany('App\Product');
    }    
    /**
     * Get the ondemand record associated with the subcategory.
     */
    public function ondemand()
    {
        return $this->hasMany('App\Ondemand');
    } 

    /**
     * Get the ondemand product record associated with the subcategory.
     */
    public function ondemandProduct()
    {
        return $this->hasMany('App\Ondemandproduct');
    } 

    /**
     * Get the service record associated with the category.
     */
    public function service()
    {
        return $this->hasMany('App\Service');
    }  

}
