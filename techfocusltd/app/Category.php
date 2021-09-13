<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * Get the product record associated with the category.
     */
    public function product()
    {
        return $this->hasMany('App\Product');
    }
	
	/**
     * Get the blog record associated with the category.
     */
    public function blog()
    {
        return $this->hasMany('App\Blog');
    }

    /**
     * Get the news record associated with the category.
     */
    public function news()
    {
        return $this->hasMany('App\News');
    }
	
	/**
     * Get the SubCategory record associated with the category.
     */
    public function subcategory()
    {
        return $this->hasMany('App\Subcategory');
    }

    /**
     * Get the blog record associated with the category.
     */
    public function featuredContent()
    {
        return $this->hasMany('App\Featuredcontent');
    }
	
}
