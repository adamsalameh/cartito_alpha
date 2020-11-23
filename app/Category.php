<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title','slug'
    ];

    /**
     * Get the sub categories for the category.
     */
    public function subCategory()
    {
        return $this->hasMany('App\SubCategory');
    }
}
