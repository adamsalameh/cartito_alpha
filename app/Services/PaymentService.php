<?php
 
namespace App\Services;

use App\Repositories\PaymentRepository; 
use App\Repositories\OrderRepository;
use App\Repositories\OrderProductRepository;
use Illuminate\Http\Request;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Cartalyst\Stripe\Exception\CardErrorException;
use Auth;
 
class PaymentService
{
	protected $paymentRepository;
	protected $orderRepository;
	protected $orderProductRepository;

	public function __construct(
		OrderRepository $orderRepository,
		OrderProductRepository $orderProductRepository,
		PaymentRepository $paymentRepository
	) {
		$this->paymentRepository = $paymentRepository;
		$this->orderRepository = $orderRepository;
		$this->orderProductRepository = $orderProductRepository;
	}
 
	public function index()
	{		
		$payments = $this->paymentRepository->getAllUserPayments(Auth::user()->id);
		$data = ['payments' => $payments];
		return $data;
	}

    public function paypalSuccess(Request $request)
    {
		$user_id = Auth::user()->id;
		$order_id = $request['item_number'];
		$payment_method= 'paypal';
		$transaction_id = $request['tx'];
		$total_amount = $request['amt'];
		$currency = $request['cc'];
		$status = $request['st'];
		$customer_ip = $_SERVER['REMOTE_ADDR'];
		$this->paymentRepository->create($user_id, $order_id, $payment_method,
			$transaction_id, $total_amount, $currency, $status, $customer_ip
		);
		return $request;
    }

    public function getOrder($order_id)
    {
        $order = $this->orderRepository->find($order_id);
        $orderProducts = $this->orderProductRepository->find($order->id);  
        return $data = [
        	'order' => $order,
        	'orderProducts' => $orderProducts
        ]; 
    } 

    public function stripePost(Request $request, $order_id)
    {
    	$order = $this->orderRepository->find($order_id);
    	$orderProducts = $this->orderProductRepository->find($order->id);
        try {
            $charge = Stripe::charges()->create([
                'amount'        => $order->total_amount,
                'currency'      => $order->currency,
                'source'        => $request->stripeToken,
                'description'   => $order->id,
                'receipt_email' => $order->email,
                'metadata'      => [
                	                 'contents' => 'order',
	                                 // 'quantity' => 2,
	                                 // 'discount' => 0,
	                                ],
            ]);
        } catch (CardErrorException $e) {
        	return $e->getMessage();
	        $this->addToOrdersTables($request, $e->getMessage());	        
            return back()->withErrors('Error! ' . $e->getMessage());
        }
        $user_id = Auth::user()->id;
		$order_id = $order->id;
		$payment_method= 'CC';
		$transaction_id = $charge['id'];
		$total_amount = $charge['amount'] / 100;
		$currency = $charge['currency'];
		$status = $charge['status'];
		$customer_ip = $_SERVER['REMOTE_ADDR'];
        $data = $this->paymentRepository->create($user_id, $order_id, $payment_method,
	        $transaction_id, $total_amount, $currency, $status, $customer_ip
	    );
		return $data;
    }    
}