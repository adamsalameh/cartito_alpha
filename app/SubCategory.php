<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'title',
        'slug'
    ];

    /**
     * Get the category of the sub category.
     */
    public function category()
    {
    	return $this->belongsTo('App\Category');
    }

    /**
     * Get the products for the sub category.
     */
    public function product()
    {
        return $this->hasMany('App\Product');
    }
}
