<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'type',
        'value',
        'start_date',
        'end_date',
        'is_active'
    ];

    /**
     * Get the product of the promotion.
     */
    public function product()
    {
        return $this->hasMany('App\Product');                
    }
}
