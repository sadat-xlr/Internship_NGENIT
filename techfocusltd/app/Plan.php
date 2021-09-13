<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    /**
     * Get the salesman that owns the plan.
     */
    public function salesman()
    {
        return $this->belongsTo('App\Client');
    }

    /**
     * Get the client that owns the plan.
     */
    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    /**
     * Get the minicategory that owns the plan.
     */
    public function minicategory()
    {
        return $this->belongsTo('App\Minicategory');
    }
}
