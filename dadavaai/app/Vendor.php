<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
     /**
     * Get the product Provide category sub category minicategory record associated with the vendor.
     */
    public function productProdive()
    {
        return $this->hasOne('App\Productprovide');
    }

    //which ondemand/RFQS belong to this vendors

    public function ondemands()
    {
        return $this->belongsToMany('App\Ondemand');
    }

    /**
     * Get the quotation record associated with the vendor.
     */
    public function quotation()
    {
        return $this->hasOne('App\Quotation');
    }

    /**
     * Get the product record associated with the vendor.
     */
    public function products()
    {
        return $this->hasMany('App\Product');
    }    

    /**
     * Get the product record associated with the vendor.
     */
    public function vendorProductOrders()
    {
        return $this->hasMany('App\Vendorproductorder');
    } 
    
}
