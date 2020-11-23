<?php

namespace App\Repositories;

interface WishListProductRepositoryInterface
{
    public function create($wish_list_id, $product_id);    
    public function all();
    public function find($id);
    public function delete($id);
    public function findUserWishListProduct($wish_list_id, $product_id);
    public function findAllUserWishListProducts($wish_list_id);
}