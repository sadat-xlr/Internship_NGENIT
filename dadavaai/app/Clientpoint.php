<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clientpoint extends Model
{
    /**
     * Get the client that owns the point table.
     */
    public function client()
    {
        return $this->belongsTo('App\Client');
    }
}
