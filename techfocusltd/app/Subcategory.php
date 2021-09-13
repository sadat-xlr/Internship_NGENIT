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
     * Get the MiniCategory record associated with the subcategory.
     */
    public function minicategory()
    {
        return $this->hasMany('App\Minicategory');
    }
}
