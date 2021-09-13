<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * Get the product record associated with the category.
     */
    public function product()
    {
        return $this->hasMany('App\Product');
    }    
    
    /**
     * Get the SubCategory record associated with the category.
     */
    public function subcategory()
    {
        return $this->hasMany('App\Subcategory');
    }

    /**
     * Get the ondemand record associated with the category.
     */
    public function ondemand()
    {
        return $this->hasMany('App\Ondemand');
    } 
    /**
     * Get the ondemand product record associated with the category.
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
