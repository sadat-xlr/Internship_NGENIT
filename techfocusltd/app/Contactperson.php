<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contactperson extends Model
{
    /**
     * Get the client that owns the contactperson.
     */
    public function client()
    {
        return $this->belongsTo('App\Client');
    }
}
