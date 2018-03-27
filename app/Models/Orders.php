<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Helper;

class Orders extends Model {

    public $table = 'orders';

    const dicountMin = 25;

    protected $fillable = [
        'order_id',
        'email',
        'total_amount_net',
        'shipping_costs',
        'payment_method',
        'discount_percentage',
        'discount_value',
        'total_after_discount'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'order_id' => 'required',
        'email' => 'required|email',
        'total_amount_net' => 'required',
        'shipping_costs' => 'required',
        'payment_method' => 'required'
    ];

    public function calculateDiscountPercentage() {

        $discountPercentage = 0;
        $discountMaxPercentage = env('DISCOUNT_MAX_PERCENTAGE');
        
        $content = Helper::webContentExtractor();
        $stringCount = Helper::stringCount($content);
        
        if ($stringCount > 0) {
            $discountPercentage = $stringCount;
            
            if ($stringCount > $discountMaxPercentage) {
                $discountPercentage = $discountMaxPercentage;
            }
        }
        
        return $discountPercentage;
    }
    
    public function calculateDiscountValue($totalAmount){
        
        $discountPercentage = $this->calculateDiscountPercentage();
        $discountValue = $totalAmount * $discountPercentage / 100;
        return $discountValue;
    }
    
    public function calculateTotalAfterDiscount($totalAmount, $discountValue){
        $totalAfterDiscount = $totalAmount - $discountValue;
        return $totalAfterDiscount;
    }

}
