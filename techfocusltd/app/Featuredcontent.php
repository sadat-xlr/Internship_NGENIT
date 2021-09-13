<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Featuredcontent extends Model
{
    /**
     * Get the category that owns the content.
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    /**
     * Get the tag record associated with the product.
     */
    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }
}
