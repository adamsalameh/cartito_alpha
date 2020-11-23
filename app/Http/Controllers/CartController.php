<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCartRequest;
use App\Services\CartService;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $data = $this->cartService->index();
        return view('carts.index', $data);
    }

    public function check()
    {    
        if (isset($_COOKIE['session_id'])) {         
           return redirect("/carts");
        }                   
        return "Please enable your cookies";              
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($product_id)
    {
        $this->cartService->addProductToCart($product_id);        
        return redirect()->back()->with('success','The product added to the cart!');
    }    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCartRequest $request, $id)
    {
        $this->cartService->updateQuantity($request, $id);           
        return redirect()->back()->with('success', 'The product\'s quantity updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cart_id)
    {
        $this->cartService->delete($cart_id);
        return redirect()->back()->with('success','The cart is empty!');
    }

    /**
     * Remove one product from storage
     *
     * @param  int $product_id
     * @return \Illuminate\Http\Response
     */
    public function destroyProduct($product_id)
    {
        $this->cartService->removeProductFromCart($product_id);
        return redirect()->back()->with('success','The product removed from the cart!');
    }
}
