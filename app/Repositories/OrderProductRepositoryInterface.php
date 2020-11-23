<?php

namespace App\Repositories;

interface OrderProductRepositoryInterface
{
    public function create($attributes);
    public function all();
    public function find($order_id);
    public function update($attributes);
    public function delete($id);
    public function getAllOrders();
    public function getAllUserOrderProducts($user_id);    
}