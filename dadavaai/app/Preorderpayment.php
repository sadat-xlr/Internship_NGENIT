<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Preorderpayment extends Model
{
    /**
     * Get the category that owns the product.
     */
    public function preorder()
    {
        return $this->belongsTo('App\Preorder');
    }

    /**
     * Get the category that owns the product.
     */
    public function payment()
    {
        return $this->belongsTo('App\Payment');
    }
}
