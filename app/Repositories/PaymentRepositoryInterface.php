<?php

namespace App\Repositories;

interface PaymentRepositoryInterface
{
    public function create(
        $user_id,
        $order_id,
        $payment_method,
        $transaction_id,
        $amount,
        $currency,
        $status,
        $customer_ip
    );    
    
    public function all();
    public function find($id);
    public function update($attributes);
    public function delete($id);    
    public function getAllUserPayments($user_id);
}