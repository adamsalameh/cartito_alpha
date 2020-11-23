<?php

namespace App\Repositories;

use App\WishList;

class WishListRepository implements WishListRepositoryInterface
{
    protected $wishList;

    public function __construct(WishList $wishList)
    {
        $this->wishList = $wishList;
    }
    
    public function create($user_id)
    {
        $wishList = new WishList();
        $wishList->user_id = $user_id;
        $wishList->save();
        return $wishList;
    }
    
    public function all()
    {
        return $this->wishList->all();
    }

    public function find($id)
    {
        return $this->wishList->find($id);
    }

    public function update($attributes)
    {
        return $this->wishList->update($attributes);
    }

    public function delete($id)
    {
        return $this->wishList->find($id)->delete();
    }

    public function findUserWishList($user_id)
    {
        $wishList = WishList::where('user_id', $user_id)->first();
        return $wishList; 
    }
}