<?php

namespace App\Repositories;

interface WishListRepositoryInterface
{
    public function create($user_id);    
    public function all();
    public function find($id);
    public function update($attributes);
    public function delete($id);
    public function findUserWishList($user_id);    
}