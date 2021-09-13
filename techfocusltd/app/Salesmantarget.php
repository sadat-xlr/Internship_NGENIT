<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salesmantarget extends Model
{
    /**
     * Get the Salesman that owns the target.
     */
    public function salesman()
    {
        return $this->belongsTo('App\Salesman');
    }
}
