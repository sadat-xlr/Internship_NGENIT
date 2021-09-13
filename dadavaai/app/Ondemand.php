<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ondemand extends Model
{
    /**
     * Get the category that owns this ondemand/ RFQS
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    
    /**
     * Get the subcategory that owns this ondemand/ RFQS
     */
    public function subcategory()
    {
        return $this->belongsTo('App\Subcategory');
    }    

    /**
     * Get the minicategory that owns this ondemand/ RFQS
     */
    public function minicategory()
    {
        return $this->belongsTo('App\Minicategory');
    }


    //which vendor have this ondemand/ RFQS
    public function vendors()
    {
        return $this->belongsToMany('App\Vendor');
    }

    /**
     * Get the Quotation record associated with this ondemand/ RFQS
     */
    public function quotations()
    {
        return $this->hasMany('App\Quotation');
    } 

    /**
     * Get the minicategory that owns this ondemand/ RFQS
     */
    public function client()
    {
        return $this->belongsTo('App\Client');
    }
    /**
     * Get the ondemandOrder that owns the orderDetails.
     */
    public function ondemandOrder()
    {
        return $this->hasOne('App\Ondemandorder');
    }

}
