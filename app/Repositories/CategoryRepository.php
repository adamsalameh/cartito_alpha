<?php

namespace App\Repositories;

use App\Category;

class CategoryRepository implements CategoryRepositoryInterface
{
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }
    
    public function create($attributes)
    {
        return $this->category->create($attributes);
    }
    
    public function all()
    {
        return $this->category->all();
    }

    public function find($id)
    {
        return $this->category->findOrFail($id);
    }

    public function update($attributes)
    {
        return $this->category->update($attributes);
    }

    public function delete($id)
    {
        return $this->category->findOrFail($id)->delete();
    }
}