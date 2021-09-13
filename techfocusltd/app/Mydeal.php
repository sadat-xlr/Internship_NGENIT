<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mydeal extends Model
{
    /**
     * Get the salesman that owns the mydeal.
     */
    public function salesman()
    {
        return $this->belongsTo('App\Salesmans');
    }

    /**
     * Get the client that owns the mydeal.
     */
    public function client()
    {
        return $this->belongsTo('App\Client');
    }
}
