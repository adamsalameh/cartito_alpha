<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartProduct extends Model
{
    protected $subTotal;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'quantity'
    ];

    /**
     * Get the cart of the cart product.
     */
    public function cart()
    {
        return $this->belongsTo('App\Cart');
    }

    /**
     * Get the product of the cart product.
     */
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
