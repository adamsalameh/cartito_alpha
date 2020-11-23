<?php

namespace App\Repositories;

use App\OrderProduct;

class OrderProductRepository implements OrderProductRepositoryInterface
{
    protected $orderProduct;

    public function __construct(OrderProduct $orderProduct)
    {
        $this->orderProduct = $orderProduct;
    }
    
    public function create($attributes)
    {
        return $this->orderProduct->create($attributes);
    }
    
    public function all()
    {
        return $this->orderProduct->all()->orderBy('created_at', 'desc')->get();
    }

    public function find($order_id)
    {
        return $this->orderProduct->all()->where('order_id',$order_id);
    }

    public function update($attributes)
    {
        return $this->orderProduct->update($attributes);
    }

    public function delete($id)
    {
        return $this->orderProduct->find($id)->delete();
    }

    public function getAllOrders()
    {
        $orderProducts = $this->orderProduct->orderBy('created_at', 'desc')->get();
        return $orderProducts;
    }

    public function getAllUserOrderProducts($user_id)
    {
        $orderProducts = $this->orderProduct->where('user_id',$user_id)->orderBy('created_at', 'desc')->get();
        return $orderProducts;
    }
}