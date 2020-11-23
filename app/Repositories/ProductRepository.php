<?php

namespace App\Repositories;

use App\Product;

class ProductRepository implements ProductRepositoryInterface
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }
    
    public function create($attributes)
    {
        return $this->product->create($attributes);
    }
    
    public function all()
    {
        return $this->product->all();
    }

    public function paginate()
    {
        return $this->product->paginate(12);
    }

    public function find($id)
    {
        return $this->product->findOrFail($id);
    }

    public function update($attributes)
    {
        return $this->product->update($attributes);
    }

    public function delete($id)
    {
        return $this->product->findOrFail($id)->delete();
    }

    public function getProductsBySubCategory($subCategory, $priceSort)
    {
        $products = Product::where('sub_category_id', $subCategory)->when(
            $priceSort, function ($query, $priceSort) { 
                return $query->orderBy('price', $priceSort);
                }, function ($query) {
                return $query->orderBy('id');
            })->paginate(9);
        return $products;
    }

    public function getProductsBySubCategoryAndBrand($subCategory, $priceSort, $selectedBrands)
    {
        $products = Product::where('sub_category_id',$subCategory)->whereIn('brand_id',$selectedBrands)->when($priceSort, function ($query, $priceSort) {
                    return $query->orderBy('price', $priceSort);
                }, function ($query) {
                    return $query->orderBy('id');
                })->paginate(9);
        return $products;
    }
}