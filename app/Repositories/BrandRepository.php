<?php

namespace App\Repositories;

use App\Brand;

class BrandRepository implements BrandRepositoryInterface
{
    protected $brand;

    public function __construct(Brand $brand)
    {
        $this->brand = $brand;
    }
    
    public function create($attributes)
    {
        return $this->brand->create($attributes);
    }
    
    public function all()
    {
        return $this->brand->all();
    }

    public function find($id)
    {
        return $this->brand->findOrFail($id);
    }

    public function update($attributes)
    {
        return $this->brand->update($attributes);
    }

    public function delete($id)
    {
        return $this->brand->findOrFail($id)->delete();
    }
}
