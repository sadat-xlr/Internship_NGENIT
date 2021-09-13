<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    /**
     * Get the category that owns the blog.
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
