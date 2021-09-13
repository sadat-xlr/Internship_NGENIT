<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    /**
     * Get the category that owns the Blog.
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    /**
     * Get the blogcomment that owns this blog.
     */
    public function blogComments()
    {
        return $this->hasMany('App\Blogcomment');
    }
}
