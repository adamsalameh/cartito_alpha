<?php

namespace App\Traits;

trait PromotionTrait
{
    public function promotionPrice($promotion, $price)
    {   
        return (float)str_replace(',', '',number_format($this->promotionType($promotion, $price), 2));
    }

    public function promotionType($promotion, $price)
    {
        
        if ($promotion['type'] == 'percentage') {
            return $this->promotionPercentage($price, $promotion->value);
        } elseif ($promotion['type'] == 'discount') {
            return $this->promotionDiscount($price, $promotion->value);
        }
    }

    public function promotionPercentage($price, $value)
    {
        return $price -( $price * $value /100 ); 
    }

    public function promotionDiscount($price, $value)
    {
        return $price - $value;
    }

    public function finalProductPrice($promotion, $price)
    {
        if ($promotion) {
            return $this->promotionPrice($promotion, $price);
        }
        return $price;
    }

    
}