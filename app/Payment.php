<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'order_id',
        'payment_method',
        'transaction_id',
        'total_amount',
        'currency',
        'status',
        'customer_ip',
        'post_code',        
    ];

    /**
     * Get the user of the payment.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the order fpr the payment.
     */
    public function order()
    {
        return $this->belongsTo('App\Order');
    }    
}
