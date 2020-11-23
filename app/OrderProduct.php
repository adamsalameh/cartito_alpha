<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id', 'product_id', 'product_name', 'price', 'quantity', 'subtotal'
    ];

    /**
     * Get the order for the order product.
     */
    public function order()
    {
        return $this->belongsTo('App\Order');
    }
}
