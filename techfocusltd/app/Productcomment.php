<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productcomment extends Model
{
     /**
     * Get the blog that owns the comment.
     */
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
