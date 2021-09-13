<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialFacebookAccount extends Model
{
    protected $fillable = ['client_id', 'provider_user_id', 'provider'];

    public function client()
    {
        return $this->belongsTo('App\Client');
    }
}
