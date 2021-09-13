<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Minicategory extends Model
{
    /**
     * Get the subcategory that owns the minicategory.
     */
    public function subcategory()
    {
        return $this->belongsTo('App\Subcategory');
    }
    /**
     * Get the tab record associated with the minicategory.
     */
    public function tabs()
    {
        return $this->hasMany('App\Tab');
    }

    /**
     * Get the product record associated with the Minicategory.
     */
    public function product()
    {
        return $this->hasMany('App\Product');
    }


    /**
     * Get the ondemand record associated with the minicategory.
     */
    public function ondemand()
    {
        return $this->hasMany('App\Ondemand');
    }    

        /**
     * Get the ondemand product record associated with the minicategory.
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
