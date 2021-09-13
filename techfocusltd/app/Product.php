<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * Get the solution that owns the product.
     */
    public function solution()
    {
        return $this->belongsTo('App\Solution');
    }
    /**
     * Get the subsolution that owns the product.
     */
    public function subsolution()
    {
        return $this->belongsTo('App\Subsolution');
    }

    /**
     * Get the category that owns the product.
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
	
	/**
     * Get the brand that owns the product.
     */
    public function brand()
    {
        return $this->belongsTo('App\Brand');
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
     * Get the Technology that owns the product.
     */
    public function technology()
    {
        return $this->belongsTo('App\Technology');
    }
	
	/**
     * Get the Industry that owns the product.
     */
    public function industry()
    {
        return $this->belongsTo('App\Industry');
    }
	
	/**
     * Get the cart record associated with the product.
     */
    public function cart()
    {
        return $this->hasOne('App\Cart');
    }
	
	/**
     * Get the compare record associated with the product.
     */
    public function compare()
    {
        return $this->hasOne('App\Compare');
    }
	
	/**
     * Get the wishlist record associated with the product.
     */
    public function wishlist()
    {
        return $this->hasOne('App\Wishlist');
    }
	
	/**
     * Get the image record associated with the product.
     */
    public function image()
    {
        return $this->hasOne('App\Image');
    }

    /**
     * Get the review record associated with the product.
     */
    public function productcomments()
    {
        return $this->hasMany('App\Productcomment');
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
     * Get the tag record associated with the product.
     */
    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    /**
     * Get the deals record associated with the product.
     */
    public function deals()
    {
        return $this->belongsToMany('App\Deal');
    }

    /**
     * Get the offers record associated with the product.
     */
    public function offers()
    {
        return $this->belongsToMany('App\Offer');
    }

    /**
     * Get the digital innovation record associated with the product.
     */
    public function digitalInnovations()
    {
        return $this->belongsToMany('App\Digitalinnovation');
    }

    /**
     * Get the DataCenter record associated with the product.
     */
    public function dataCenters()
    {
        return $this->belongsToMany('App\Datacenter');
    }
    /**
     * Get the connected workforce record associated with the product.
     */
    public function connectedWorkforces()
    {
        return $this->belongsToMany('App\Connectedworkforce');
    }

    /**
     * Get the System Integrations record associated with the product.
     */
    public function systemIntegrations()
    {
        return $this->belongsToMany('App\Systemintegration');
    }    
}
