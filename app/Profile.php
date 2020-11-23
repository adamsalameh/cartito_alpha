<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
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
        'telephone'
    ];

    /**
     * Get the user of the profile.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
