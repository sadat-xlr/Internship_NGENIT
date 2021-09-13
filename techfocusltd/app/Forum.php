<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }
}
