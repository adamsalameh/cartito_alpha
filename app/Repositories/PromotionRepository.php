<?php

namespace App\Repositories;

use App\Promotion;
// REMOVE THE PRODUCT FORM HERE :( AND FROM DELETE METHOD AS WELL
use App\Product;

class PromotionRepository implements PromotionRepositoryInterface
{
    protected $promotion;

    public function __construct(Promotion $promotion)
    {
        $this->promotion = $promotion;
    }
    
    public function create($attributes)
    {
        return $this->promotion->create($attributes);
    }
    
    public function all()
    {
        return $this->promotion->all();
    }

    public function find($id)
    {
        return $this->promotion->findOrFail($id);
    }

    public function update($attributes)
    {
        return $this->promotion->update($attributes);
    }

    public function delete($id)
    {
        $products = Product::where('promotion_id',$id)->update(['promotion_id' => null]);
        return $this->promotion->findOrFail($id)->delete();
    }

    public function isValid($id)
    {
        $promotion = Promotion::where('id', $id)
            ->where('is_active',1)
            ->whereDate('start_date', '<=', date("Y-m-d"))
            ->whereDate('end_date', '>=', date("Y-m-d"))
            ->first();
        return $promotion; 
    }
}
