<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MembershipType extends Model
{
    /**
     * Get the client record associated with the MembershipType.
     */
    public function client()
    {
        return $this->hasMany('App\Customer');
    }
}
