<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * Get the product record associated with the tag.
     */
    public function products()
    {
        return $this->belongsToMany('App\Product');
    }

        /**
     * Get the product record associated with the tag.
     */
    public function featuredcontents()
    {
        return $this->belongsToMany('App\Featuredcontent');
    }
}
