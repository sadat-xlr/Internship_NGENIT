<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subsolution extends Model
{
    public function solution()
    {
        return $this->belongsTo('App\Solution');
    }

    public function products()
    {
        return $this->hasMany('App\Product');
    }
}
