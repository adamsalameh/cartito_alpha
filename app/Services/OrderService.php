<?php
 
namespace App\Services;
 
use App\Repositories\OrderRepository;
use App\Repositories\OrderProductRepository;
use App\Http\Requests\StoreOrderRequest;
use App\Repositories\CartRepository;
use App\Repositories\CartProductRepository;
use App\Repositories\ShippingMethodRepository;
use App\Repositories\PromotionRepository;
use App\Http\Requests\StoreOrderStatusRequest;
use App\Services\CartService;
use App\Repositories\UserRepositoryInterface;

use Auth;
 
class OrderService
{
	protected $cartRepository;
	protected $cartProductRepository;
	protected $orderRepository;
	protected $orderProductRepository;
	protected $shippingMethodRepository;
	protected $promotionRepository;
	protected $userRepository;

	public function __construct(
		CartService $cartService,
		CartRepository $cartRepository,
		CartProductRepository $cartProductRepository,
		OrderRepository $orderRepository,
		OrderProductRepository $orderProductRepository,
		ShippingMethodRepository $shippingMethodRepository,
		PromotionRepository $promotionRepository,
		UserRepositoryInterface $userRepository
	) {
		$this->cartRepository = $cartRepository;
		$this->cartProductRepository = $cartProductRepository;
		$this->orderRepository = $orderRepository;
		$this->orderProductRepository = $orderProductRepository;
		$this->shippingMethodRepository = $shippingMethodRepository;
		$this->promotionRepository = $promotionRepository;
		$this->cartService = $cartService;
		$this->userRepository = $userRepository;
	}
 
	public function index()
	{		
		$orders = $this->orderRepository->getAllUserOrders($this->userRepository->getId());
		$data = ['orders' => $orders];
		return $data;  
	}

	public function getAllOrders()
	{
		$orders = $this->orderRepository->all();
		$data = ['orders' => $orders];
		return $data;
	}
 
    public function create(StoreOrderRequest $request)
	{
        $data = $this->cartService->index();        
        $shippingMethod = $shippingMethods = $this->shippingMethodRepository->find($request['shipping_method_id']);
        
        $total = $data['total'] + $shippingMethod->fee;
        $currency = "usd";

	    $order = $this->orderRepository->create($request->validated() + [
	    	'user_id'       => $this->userRepository->getId(),
	    	'total_amount'  => $total,
	    	'currency'      => $currency,
	    	'status'        => 'pendding',
	    	'shipping_fees' => $shippingMethod->fee
	    ]);

	    foreach ($data['cartProducts'] as $cartProduct) {
        	$orderProduct = $this->orderProductRepository->create([
        		'order_id'     => $order->id,
        		'product_name' => $cartProduct->product->title,
        		'price'        => $cartProduct->product->price,
        		'quantity'     => $cartProduct->quantity,
        		'subtotal'     => $cartProduct->subTotal
        	]);
	    }	    	    
	    return $order;	    
	}

	public function edit($id)
	{
		return $this->orderRepository->find($id);
	}
 
	public function update($id, StoreOrderStatusRequest $request)
	{
	    return $this->orderRepository->updateStatus($id, $request->validated());
	}
 
	public function delete($id)
	{
		return $this->orderRepository->delete($id);
	}	

    public function find($id)
    {
    	$order = $this->orderRepository->find($id);
        $orderProducts = $this->orderProductRepository->find($order->id);
        $data = ['order' => $order, 'orderProducts' => $orderProducts];
        return $data;      
    }    
}