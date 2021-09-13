<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * Get the category that owns the product.
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    
    /**
     * Get the subcategory that owns the product.
     */
    public function subcategory()
    {
        return $this->belongsTo('App\Subcategory');
    }    

    /**
     * Get the minicategory that owns the product.
     */
    public function minicategory()
    {
        return $this->belongsTo('App\Minicategory');
    }

    /**
     * Get the tab that owns the product.
     */
    public function tab()
    {
        return $this->belongsTo('App\Tab');
    }    

    /**
     * Get the brand that owns the product.
     */
    public function brand()
    {
        return $this->belongsTo('App\Brand');
    }

    /**
     * Get the color record associated with the product.
     */
    public function colors()
    {
        return $this->belongsToMany('App\Color');
    }
    
    
    /**
     * Get the size record associated with the product.
     */
    public function sizes()
    {
        return $this->belongsToMany('App\Size');
    }

    /**
     * Get the image record associated with the product.
     */
    public function image()
    {
        return $this->hasOne('App\Image');
    }
    /**
     * Get the tag record associated with the product.
     */
    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    /**
     * Get the wishlist record associated with the product.
     */
    public function wishlist()
    {
        return $this->hasOne('App\Wishlist');
    }

    /**
     * Get the deal record associated with the product.
     */
    public function deal()
    {
        return $this->belongsTo('App\Deal');
    }

    /**
     * Get the offer record associated with the product.
     */
    public function offer()
    {
        return $this->belongsTo('App\Offer');
    }

    /**
     * Get the prebook record associated with the Product.
     */
    public function prebook()
    {
        return $this->hasOne('App\Prebook');
    }
    
    public function bundleOffers()
    {
        return $this->hasMany('App\Bundleoffer');
    }

    /**
     * Get the review associated with the client.
     */

    public function reviews()
    {
        return $this->hasMany('App\Productreview');
    }

    /**
     * Get the productInformation record associated with the product.
     */
    public function productInformation()
    {
        return $this->hasOne('App\Productinformation');
    }

}
