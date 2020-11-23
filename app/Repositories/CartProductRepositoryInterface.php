<?php

namespace App\Repositories;

interface CartProductRepositoryInterface
{
    public function create($cart_id, $product_id);   
    public function all();
    public function find($id);    
    public function update($attributes);    
    public function updateQuantity($id, $attributes);    
    public function delete($id);    
    public function exist($cart_id, $product_id);    
    public function increaseQuantity($cartProduct);    
    public function decreaseQuantity($cartProduct);    
    public function checkProductAvilability($cartProduct);    
    public function findCartProduct($cart_id);
}