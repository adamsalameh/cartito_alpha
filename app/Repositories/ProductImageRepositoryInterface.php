<?php

namespace App\Repositories;

interface ProductImageRepositoryInterface
{
    public function create($attributes);    
    public function all();
    public function find($id);
    public function findAllByProductId($product_id);
    public function save();
    public function delete($id);
}