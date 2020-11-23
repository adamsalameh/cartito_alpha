<?php

namespace App\Repositories;

use App\Order;

class OrderRepository implements OrderRepositoryInterface
{
    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }
    
    public function create($attributes)
    {
        return $this->order->create($attributes);
    }
    
    public function all()
    {
        return $this->order->all();
    }

    public function find($id)
    {
        return $this->order->find($id);
    }
    
    public function updateStatus($id, $attributes)
    {
        $order = $this->find($id);
        $order->status = $attributes['status'];
        $order->save();
        return $order;
    }

    public function delete($id)
    {
        return $this->order->find($id)->delete();
    }

    public function getAllOrders()
    {
        $orders = $this->order->orderBy('created_at', 'desc')->get();
        return $orders;
    }

    public function getAllUserOrders($user_id)
    {
        $orders = $this->order->where('user_id',$user_id)->orderBy('created_at', 'desc')->get();
        return $orders;
    }
}