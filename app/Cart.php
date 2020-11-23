<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $total;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'identifier'
    ];

    /**
     * Get the user of the cart.
     */
    // public function user()
    // {
    // 	return $this->belongsTo('App\User');
    // }

    /**
     * Get the cart products for the cart.
     */
    public function CartProduct()
    {
        return $this->hasMany('App\CartProduct');
    }
}
