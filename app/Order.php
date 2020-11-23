<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
        'telephone',
        'shipping_method_id',
        'payment_method',
        'address',
        'post_code',
        'city','country',
        'shipping_fees',
        'total_amount',
        'currency',
        'status'
    ];

    /**
     * Get the user of the order.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the order products for the order.
     */
    public function orderProduct()
    {
        return $this->hasMany('App\OrderProduct');
    }

    /**
     * Get the shipping method of the order.
     */
    public function shippingMethod()
    {
        return $this->belongsTo('App\ShippingMethod');
    }

    /**
     * Get the payment of the order.
     */
    public function payment()
    {
        return $this->hasOne('App\Payment');
    }
}
