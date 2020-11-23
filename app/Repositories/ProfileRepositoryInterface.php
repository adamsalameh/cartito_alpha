<?php

namespace App\Repositories;

interface ProfileRepositoryInterface
{
    public function create($attributes);
    public function all();
    public function find($id);  
    public function findByUserId($userId);
    public function update($attributes);  
    public function delete($id);    
}