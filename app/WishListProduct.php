<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WishListProduct extends Model
{
    /**
     * Get the wish list of the wish list product.
     */
    public function wishList()
    {
        return $this->belongsTo('App\WishList');
    }

    /**
     * Get the product of the wish list product.
     */
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
