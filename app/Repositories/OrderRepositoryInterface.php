<?php

namespace App\Repositories;

interface OrderRepositoryInterface
{
    public function create($attributes);    
    public function all();
    public function find($id);
    public function updateStatus($id, $attributes);
    public function delete($id);
    public function getAllOrders();
    public function getAllUserOrders($user_id);
}
