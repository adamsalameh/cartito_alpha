<?php

namespace App\Repositories;

interface SubCategoryRepositoryInterface
{
    public function create($attributes);
    public function all();
    public function find($id);
    public function update($attributes);
    public function delete($id);
}