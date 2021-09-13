<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Incentive extends Model
{
    /**
     * Get the mydeal record associated with the Incentive.
     */
    public function mydeal()
    {
        return $this->belongsTo('App\Mydeal');
    }

}
