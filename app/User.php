<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the profile for the user.
     */
    public function profile()
    {
       return $this->hasOne('App\Profile');
    }

    /**
     * Get the addresses for the user.
     */
    public function address()
    {
        return $this->hasMany('App\Address');
    }

    /**
     * Get the order for the user.
     */
    public function order()
    {
        return $this->hasMany('App\Order');
    }

    /**
     * Get the cart for the user.
     */
    public function cart()
    {
        return $this->hasMany('App\Cart');
    }

    /**
     * Get the wish list for the user.
     */
    public function wishList()
    {
        return $this->hasMany('App\wishList');
    }
}
