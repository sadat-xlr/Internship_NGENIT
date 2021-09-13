<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bundleoffer extends Model
{
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
