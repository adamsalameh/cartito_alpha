<?php

namespace App\Repositories;

interface CartRepositoryInterface
{  
    public function create($user_id = null, $identifier);    
    public function all();    
    public function find($id);
    public function update($attributes);
    public function delete($id);
    public function findUserCart($user_id);    
}