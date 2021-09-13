<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    /**
     * Get the category that owns the blog.
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
	
	/**
     * Get the comment record associated with the blog.
     */
    public function comment()
    {
        return $this->hasMany('App\Blogcomment');
    }
}
