<?php

namespace App\Repositories;

use App\CartProduct;

class CartProductRepository implements CartProductRepositoryInterface
{
    protected $cartProduct;

    public function __construct(CartProduct $cartProduct)
    {
        $this->cartProduct = $cartProduct;
    }
    
    public function create($cart_id, $product_id)
    {
        $cartProduct = new CartProduct();
        $cartProduct->cart_id = $cart_id;
        $cartProduct->product_id= $product_id;
        $cartProduct->quantity= 1;
        $cartProduct->save();
        return $cartProduct;
    }
    
    public function all()
    {
        return $this->cartProduct->all();
    }

    public function find($id)
    {
        return $this->cartProduct->find($id);
    }

    public function update($attributes)
    {
        return $this->cartProduct->update($attributes);
    }

    public function updateQuantity($id, $attributes)
    {
        $cartProduct = $this->find($id);
        $cartProduct->quantity= $attributes['quantity'];
        $cartProduct->save();
        return $cartProduct;
    }

    public function delete($id)
    {
        return $this->cartProduct->find($id)->delete();
    }

    /**
     * Check the user's cartProduct.
     *
     * @param  cart_id, product_id
     * @return cartProduct
     */
    public function exist($cart_id, $product_id)
    {
        $cartProduct = CartProduct::where([
            ['cart_id',$cart_id],
            ['product_id',$product_id],
            ])->first();        
        return $cartProduct; 
    }

    public function increaseQuantity($cartProduct)
    {        
        $this->cartProduct = $cartProduct;
        if ($this->cartProduct->quantity < $this->cartProduct->product->quantity) {
            $this->cartProduct->quantity++;
            $this->cartProduct->save();
        }
        return $this->cartProduct;
    }

    public function decreaseQuantity($cartProduct)
    {
        $this->cartProduct = $cartProduct;
        if ($this->cartProduct->quantity > 1) {
            $this->cartProduct->quantity--;
            $this->cartProduct->save();
        }
        return $this->cartProduct;
    }

    public function checkProductAvilability($cartProduct)
    {
        $this->cartProduct = $cartProduct;
        if ($this->cartProduct->quantity < $this->cartProduct->product->quantity) {
            $cartProduct->quantity++;
            $cartProduct->save();
        }
        return $cartProduct;
    }

    public function findCartProduct($cart_id)
    {
        return $cartProducts = CartProduct::all()->where('cart_id',$cart_id);
    } 
}