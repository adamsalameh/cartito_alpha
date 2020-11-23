<?php
 
namespace App\Services;
 

use App\Repositories\ShippingMethodRepository;

use App\Http\Requests\StoreCartRequest;
use App\Services\CartService;
 
class CheckOutService
{
	protected $cartService;
	protected $shippingMethodRepository;

    public function __construct(CartService $cartService, ShippingMethodRepository $shippingMethodRepository )
    {
        $this->cartService = $cartService;
        $this->shippingMethodRepository = $shippingMethodRepository;
    }
	
	public function index()
	{
		$data = $this->cartService->index();        
        return $data;
	}

}