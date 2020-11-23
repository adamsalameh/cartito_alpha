<?php

namespace App\Repositories;

use App\Payment;

class PaymentRepository implements PaymentRepositoryInterface
{
    protected $payment;

    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }
    
    public function create($user_id, $order_id, $payment_method, $transaction_id, $amount, $currency, $status, $customer_ip)
    {
        $payment = new Payment();
        $payment->user_id = $user_id;
        $payment->order_id = $order_id;
        $payment->payment_method= $payment_method;
        $payment->transaction_id = $transaction_id;
        $payment->total_amount = $amount;
        $payment->currency = $currency;
        $payment->status = $status;
        $payment->customer_ip = $customer_ip;
        $payment->save();
        return $payment;
    }
    
    public function all()
    {
        return $this->payment->all();
    }

    public function find($id)
    {
        return $this->payment->find($id);
    }

    public function update($attributes)
    {
        return $this->payment->update($attributes);
    }

    public function delete($id)
    {
        return $this->payment->find($id)->delete();
    }
    
    public function getAllUserPayments($user_id)
    {
        $payment = $this->payment->where('user_id',$user_id)->orderBy('created_at', 'desc')->get();
        return $payment; 
    }
}