<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    /**
     * Get the subsector that owns the client.
     */
    public function subsector()
    {
        return $this->belongsTo('App\Subsector');
    }

    /**
     * Get the contactpeople record associated with the client.
     */
    public function contactpeople()
    {
        return $this->hasMany('App\Contactperson');
    }

    /**
     * Get the Salesman that owns the client.
     */
    public function salesman()
    {
        return $this->belongsTo('App\Salesman');
    }

    /**
     * Get the membership_type that owns the client.
     */
    public function membership_type()
    {
        return $this->belongsTo('App\MembershipType');
    }

}
