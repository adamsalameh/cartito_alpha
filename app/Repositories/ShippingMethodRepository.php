<?php

namespace App\Repositories;

use App\ShippingMethod;

class ShippingMethodRepository implements ShippingMethodRepositoryInterface
{
    protected $shippingMethod;

    public function __construct(ShippingMethod $shippingMethod)
    {
        $this->shippingMethod = $shippingMethod;
    }
    
    public function create($attributes)
    {
        return $this->shippingMethod->create($attributes);
    }
    
    public function all()
    {
        return $this->shippingMethod->all();
    }

    public function find($id)
    {
        return $this->shippingMethod->findOrFail($id);
    }

    public function update($attributes)
    {
        return $this->shippingMethod->update($attributes);
    }

    public function delete($id)
    {
        return $this->shippingMethod->findOrFail($id)->delete();
    }
}