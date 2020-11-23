<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShippingMethod extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_name',
        'fee'
    ];

    /**
     * Get the order for the shipping method.
     */
    public function order()
    {
        return $this->hasMany('App\Order');
    }
}
