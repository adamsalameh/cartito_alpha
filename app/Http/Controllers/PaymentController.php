<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PaymentService;


class PaymentController extends Controller
{
    protected $paymentService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;        

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->paymentService->index();        
        return view('payments.index', $data);
    }
    
    /**
     * paypal Payment
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function payWithPaypal($order_id)
    {
        $data = $this->paymentService->getOrder($order_id);            
        return view('payments.paypal', $data);
    }

    /**
     * stripe Payment
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function payCreditCard($order_id)
    {
        $data = $this->paymentService->getOrder($order_id);
        return view('payments.stripe', $data);
    }

    public function stripePost(Request $request, $order_id)
    {
        return $data = $this->paymentService->stripePost($request, $order_id);
        
    }

    /**
     * cash Payment
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function payCash($order_id)
    {
        $data = $this->paymentService->getOrder($order_id);
        return view('payments.cash', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function paymentWithPaypalSuccess(Request $request)
    {
        return  $this->paymentService->paypalSuccess($request);
             // return Request();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function paymentFaild()
    {
        return view('payments.faild');
    }   
}
