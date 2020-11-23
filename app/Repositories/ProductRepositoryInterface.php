<?php

namespace App\Repositories;

interface ProductRepositoryInterface
{
    public function create($attributes);    
    public function all();
    public function paginate();
    public function find($id);
    public function update($attributes);
    public function delete($id);
    public function getProductsBySubCategory($subCategory, $priceSort);
    public function getProductsBySubCategoryAndBrand(
        $subCategory,
        $priceSort,
        $selectedBrands
    );
}