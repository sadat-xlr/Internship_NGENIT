<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salesman extends Model
{
    /**
     * Get the client record associated with the Salesman.
     */
    public function client()
    {
        return $this->hasMany('App\Client');
    }

    /**
     * Get the target record associated with the Salesman.
     */
    public function target()
    {
        return $this->hasMany('App\Salesmantarget');
    }

    /**
     * Get the plan record associated with the Salesman.
     */
    public function plan()
    {
        return $this->hasMany('App\Plan');
    }

    /**
     * Get the dmar record associated with the Salesman.
     */
    public function dmar()
    {
        return $this->hasMany('App\Dmar');
    }

    /**
     * Get the deal record associated with the Salesman.
     */
    public function deal()
    {
        return $this->hasMany('App\Mydeal');
    }

    /**
     * Get the deal record associated with the Salesman.
     */
    public function incentives()
    {
        return $this->hasMany('App\Incentive');
    }
}
