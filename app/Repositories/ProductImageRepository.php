<?php

namespace App\Repositories;

use App\ProductImage;

class ProductImageRepository implements ProductImageRepositoryInterface
{
    protected $productImage;

    public function __construct(ProductImage $productImage)
    {
        $this->productImage = $productImage;
    }
    
    public function create($attributes)
    {
        return $this->productImage->create($attributes);
    }
    
    public function all()
    {
        return $this->productImage->all();
    }

    public function find($id)
    {
        return $this->productImage->findOrFail($id);
    }

    public function findAllByProductId($product_id)
    {
        return $this->productImage->where('product_id', $product_id)->get();
    }

    public function save()
    {
        return $this->productImage->save();
    }

    public function delete($id)
    {
        return $this->productImage->findOrFail($id)->delete();
    }
}
