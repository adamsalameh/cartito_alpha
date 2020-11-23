<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WishList extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id'
    ];

    /**
     * Get the user of the wish list.
     */
    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    /**
     * Get the wish list products for the wish list.
     */
    public function wishListProduct()
    {
        return $this->hasMany('App\WishListProduct');
    }
}
