<?php

namespace App\Repositories;

use App\SubCategory;

class SubCategoryRepository implements SubCategoryRepositoryInterface
{
    protected $subCategory;

    public function __construct(SubCategory $subCategory)
    {
        $this->subCategory = $subCategory;
    }
    
    public function create($attributes)
    {
        return $this->subCategory->create($attributes);
    }
    
    public function all()
    {
        return $this->subCategory->all();
    }

    public function find($id)
    {
        return $this->subCategory->findOrFail($id);
    }

    public function update($attributes)
    {
        return $this->subCategory->update($attributes);
    }

    public function delete($id)
    {
        return $this->subCategory->findOrFail($id)->delete();
    }
}