<?php
 
namespace App\Services;
 
use App\Http\Requests\StoreCartRequest;
use App\Repositories\CartRepositoryInterface;
use App\Repositories\CartProductRepositoryInterface;
use App\Repositories\ShippingMethodRepositoryInterface;
use App\Repositories\PromotionRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Traits\PromotionTrait;

 
class CartService
{
	use PromotionTrait;

	protected $cartRepository;
	protected $cartProductRepository;
	protected $promotionRepository;
	protected $shippingMethodRepository;
	protected $userRepository;

	public function __construct(
		CartRepositoryInterface $cartRepository,
		CartProductRepositoryInterface $cartProductRepository,
		ShippingMethodRepositoryInterface $shippingMethodRepository,
		PromotionRepositoryInterface $promotionRepository,
		UserRepositoryInterface $userRepository
	) {
		$this->cartRepository = $cartRepository;
		$this->cartProductRepository = $cartProductRepository;
		$this->shippingMethodRepository = $shippingMethodRepository;
		$this->promotionRepository = $promotionRepository;
		$this->userRepository = $userRepository;
	}
 
	public function index()
	{
		
		if (isset($_COOKIE['session_id'])) {
			$identifier = $_COOKIE['session_id'];			
	    } else {
	    	$session_id = session()->getId();
	    	setcookie('session_id', $session_id, time()+60*60*24*365);	    	
	    	header('Location:http://127.0.0.1:8000/carts/check');
            exit;	    	
	    }

		if ($this->userRepository->isLogged()) {
		    $sessionCart = $this->cartRepository->findCartByIdentifier($identifier);
		    $cart = $this->cartRepository->findUserCart($this->userRepository->getId());

			if (!$cart) {
				if (!$sessionCart) {
			        $cart = $this->cartRepository->create($identifier, $this->userRepository->getId());
			    } else {
			        if (is_null($sessionCart->user_id)) {				       
				    	$this->cartRepository->find($sessionCart->id)->update(['user_id' => $this->userRepository->getId()]);
				    	$cart = $this->cartRepository->findCartByIdentifier($identifier);

			        } else {			        	
			        	setcookie('session_id', '', time() - 3600);
			        	session()->regenerate();			        	
					    $session_id = session()->getId();
						setcookie('session_id', $session_id, time()+60*60*24*365);
						$identifier = $_COOKIE['session_id'];						
						$cart = $this->cartRepository->create($session_id, $this->userRepository->getId());
			        }
			    }
			} else {				
			    if ($sessionCart) {			    	
			    	if (is_null($sessionCart->user_id)) {
				        $cartProductsSession = $this->cartProductRepository->findCartProduct($sessionCart->id);
				        foreach ($cartProductsSession as $cartProduct) {
				            if (!$this->cartProductRepository->exist($cart->id, $cartProduct->product_id)) {                      
				                $cartProduct = $this->cartProductRepository->create($cart->id, $cartProduct->product_id);	
				            }      
				        }
				        $this->cartRepository->delete($sessionCart->id);
				    } elseif ($sessionCart->user_id != $this->userRepository->getId()) {
				    	setcookie('session_id', '', time() - 3600);
			        	session()->regenerate();			        	
					    $session_id = session()->getId();
						setcookie('session_id', $session_id, time()+60*60*24*365);
						$identifier = $_COOKIE['session_id'];						
				    }    			        	       
			    }
			    setcookie('session_id', $cart->identifier, time()+60*60*24*365);                
			}			
		} else {
           $cart = $this->cartRepository->findCartByIdentifier($identifier);
           if (!$cart) {
            $cart = $this->cartRepository->create($identifier);
           }
		}	

		
		$total = 0;	
		$cartProducts = $this->cartProductRepository->findCartProduct($cart->id);
        $shippingMethods = $this->shippingMethodRepository->all();
        foreach ($cartProducts as $cartProduct) {
        	$promotion = $this->promotionRepository->isValid($cartProduct->product->promotion_id);
            if ($promotion) {
				$cartProduct->product->promotionPrice = $this->promotionPrice($promotion, $cartProduct->product->price);
            }
        	$cartProduct->subTotal = $this->finalProductPrice($promotion, $cartProduct->product->price) * $cartProduct->quantity;
        	$total += $cartProduct->subTotal;
	    }
        $data = [
        	'cart'            => $cart,
        	'cartProducts'    => $cartProducts,
        	'total'           => $total,
        	'shippingMethods' => $shippingMethods
        ];
        return $data;		
	}

	public function check()
	{		
        if (isset($_COOKIE['session_id']) || $this->userRepository->isLogged()) {         
           return true;
        }                   
        return false;   
	}	

	public function updateQuantity($request, $id)
	{
		$cartProduct = $this->cartProductRepository->find($id);        
		return $this->cartProductRepository->updateQuantity($cartProduct->id, $request->validated());
	}
 
	public function delete($id)
	{
		return $this->cartRepository->delete($id);
	}

	public function removeProductFromCart($id)
	{
		return $this->cartProductRepository->delete($id);
	}

	/**
     * Get the user's cart or Create new one.
     * add the product to the cart or increase it 
     * @param  user_id
     * @return Cart
     */
	
	public function addProductToCart($product_id)
	{   
		 if (isset($_COOKIE['session_id'])) {
			    $identifier = $_COOKIE['session_id'];
		    } else {
		    	$session_id = session()->getId();
		    	setcookie('session_id', $session_id, time()+60*60*24*365);
		    	$identifier = $session_id;
		    }

		if ($this->userRepository->isLogged()) {
		    $sessionCart = $this->cartRepository->findCartByIdentifier($identifier);
		    $cart = $this->cartRepository->findUserCart($this->userRepository->getId());
			if (!$cart) {
				if (!$sessionCart) {
			        $cart = $this->cartRepository->create($identifier, $this->userRepository->getId());
			    } else {
			    	$sessionCart = $this->cartRepository->findCartByIdentifier($identifier);
			    	$cartProductsSession = $this->cartProductRepository->findCartProduct($sessionCart->id);
			        foreach ($cartProductsSession as $cartProduct) {
			            if (!$this->cartProductRepository->exist($cart->id, $cartProduct->product_id)) {                        
			                $cartProduct = $this->cartProductRepository->create($cart->id, $cartProduct->product_id);	
			            }      
			        }
			    	$cart = $this->cartRepository->find($sessionCart->id)->update(['user_id' => $this->userRepository->getId()]);
			    	//$this->cartRepository->delete($sessionCart->id);

			    }
			} else {
			    if ($sessionCart) {
			        $cartProductsSession = $this->cartProductRepository->findCartProduct($sessionCart->id);
			        foreach ($cartProductsSession as $cartProduct) {
			            if (!$this->cartProductRepository->exist($cart->id, $cartProduct->product_id)) {                      
			                $cartProduct = $this->cartProductRepository->create($cart->id, $cartProduct->product_id);	
			            }      
			        }			        
			    }               
			}
		} else {
           $cart = $this->cartRepository->findCartByIdentifier($identifier);
           if (!$cart) {
               $cart = $this->cartRepository->create($identifier);
           }
		}

	    $cartProduct = $this->cartProductRepository->exist($cart->id, $product_id);
	    if (!$cartProduct) {
            $cartProduct = $this->cartProductRepository->create($cart->id, $product_id);   
        } else {		
		    if ($cartProduct->quantity < $cartProduct->product->quantity) {
            $this->cartProductRepository->increaseQuantity($cartProduct);            	
            } 
        }       
        return $cartProduct;			
    }

       public function getCookie()
       {       	    
		    if (isset($_COOKIE['session_id'])) {
			    $cookie = $_COOKIE['cookie'];
		    } else {
		    	$session_id = session()->getId();
		    	setcookie('session_id', $session_id, time()+60*60*24*365);
		    	$cookie = $_COOKIE['session_id'];
		    }
       } 
}




