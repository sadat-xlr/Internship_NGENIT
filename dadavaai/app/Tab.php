<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tab extends Model
{
    /**
     * Get the minicategory that owns the Tab.
     */
    public function minicategory()
    {
        return $this->belongsTo('App\Minicategory');
    }

    /**
     * Get the product record associated with the category.
     */
    public function products()
    {
        return $this->hasMany('App\Product');
    }   
    /**
     * Get the product record associated with the category.
     */
    public function services()
    {
        return $this->hasMany('App\Service');
    }   
}
