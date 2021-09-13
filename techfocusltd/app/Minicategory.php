<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Minicategory extends Model
{
    /**
     * Get the subcategory that owns the minicategory.
     */
    public function subcategory()
    {
        return $this->belongsTo('App\Subcategory');
    }
}
