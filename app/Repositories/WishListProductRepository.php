<?php

namespace App\Repositories;

use App\WishListProduct;

class WishListProductRepository implements WishListProductRepositoryInterface
{
    protected $wishListProduct;

    public function __construct(WishListProduct $wishListProduct)
    {
        $this->wishListProduct = $wishListProduct;
    }
    
    public function create($wish_list_id, $product_id)
    {
        $wishListProduct = new WishListProduct();
        $wishListProduct->wish_list_id = $wish_list_id;
        $wishListProduct->product_id= $product_id;
        $wishListProduct->save();
        return $wishListProduct;
    }
    
    public function all()
    {
        return $this->wishListProduct->all();
    }

    public function find($id)
    {
        return $this->wishListProduct->find($id);
    }

    public function delete($id)
    {
        return $this->wishListProduct->find($id)->delete();
    }

    /**
     * Check the user's wishListProduct.
     *
     * @param  cart_id, product_id
     * @return wishListProduct
     */
    public function findUserWishListProduct($wish_list_id, $product_id)
    {
        $wishListProduct = wishListProduct::where([
            ['wish_list_id',$wish_list_id],
            ['product_id',$product_id],
            ])->first();        
        return $wishListProduct; 
    }

    public function findAllUserWishListProducts($wish_list_id)
    {
        return $wishListProducts = WishListProduct::all()->where('wish_list_id',$wish_list_id);
    } 
}