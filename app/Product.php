<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $promotionPrice = null;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'brand_id',
        'sub_category_id',
        'tag',
        'quantity',
        'price',
        'in_stock',
        'promotion_id',
        'description',
    ];

    /**
     * Get the promotion for the product.
     */
    public function promotion()
    {
        return $this->belongsTo('App\Promotion');
    }

    /**
     * Get the subCategory of the product.
     */
    public function subCategory()
    {
        return $this->belongsTo('App\SubCategory');
    }

    /**
     * Get the brand of the product.
     */
    public function brand()
    {
    	return $this->belongsTo('App\Brand');
    }

    /**
     * Get the product image for the product.
     */
    public function productImage()
    {
    	return $this->hasMany('App\ProductImage');
    }
}
