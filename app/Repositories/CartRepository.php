<?php

namespace App\Repositories;

use App\Cart;

class CartRepository implements CartRepositoryInterface
{
    protected $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }
    
    public function create($identifier, $user_id = null)
    {
        $cart = new Cart();
        $cart->user_id = $user_id;
        $cart->identifier = $identifier;
        $cart->save();
        return $cart;
    }
    
    public function all()
    {
        return $this->cart->all();
    }

    public function find($id)
    {
        return $this->cart->findOrFail($id);
    }

    public function update($attributes)
    {
        return $this->cart->update($attributes);
    }

    public function delete($id)
    {
        return $this->cart->findOrFail($id)->delete();
    }

    /**
     * find the user's cart.
     *
     * @param  user_id
     * @return Cart
     */
    public function findUserCart($user_id)
    {
        $cart = Cart::where('user_id', $user_id)->first();
        return $cart; 
    }

    /**
     * find the user's cart.
     *
     * @param  identifier
     * @return Cart
     */
    public function findCartByIdentifier($identifier)
    {
        $cart = Cart::where('identifier', $identifier)->first();
        return $cart; 
    }

    
    
    
}