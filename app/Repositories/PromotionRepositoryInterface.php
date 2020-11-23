<?php

namespace App\Repositories;

interface PromotionRepositoryInterface
{
    public function create($attributes);    
    public function all();
    public function find($id);
    public function update($attributes);

    /*
     * should remove the dependecy from product class
     */
    public function delete($id);
    // {
    //     $products = Product::where('promotion_id',$id)->update(['promotion_id' => null]);
    //     return $this->promotion->find($id)->delete();
    // }


    /*
     * return the promotion if valids
     */
    public function isValid($id);    
}

