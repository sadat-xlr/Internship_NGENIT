<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
       /**
     * Get the client that owns the message.
     */
    public function client()
    {
        return $this->belongsTo('App\Client');
    }
}
