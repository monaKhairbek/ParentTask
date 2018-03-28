<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Helper;

class Orders extends Model {

    public $table = 'orders';
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
    
    /*
     * Description: Method to calculate discount Percentage
     */
    public function calculateDiscountPercentage() {

        $discountPercentage = 0;
        $discountMaxPercentage = env('DISCOUNT_MAX_PERCENTAGE');

        $content = Helper::webContentExtractor();       // Get Web Page content
        $stringCount = Helper::stringCount($content);   //  Cout Discount string in extracted Content

        if ($stringCount > 0) {
            $discountPercentage = $stringCount;

            if ($stringCount > $discountMaxPercentage) {
                $discountPercentage = $discountMaxPercentage;
            }
        }

        return $discountPercentage;
    }

    
    /*
     * Description: Calculate Discount value from total amount and calculated percentage
    */
    
    public function calculateDiscountValue($totalAmount) {

        $discountPercentage = $this->calculateDiscountPercentage();
        $discountValue = $totalAmount * $discountPercentage / 100;
        return $discountValue;
    }

    /*
     * Description: Calculate total amount after decreasing the cisount value
     */
    public function calculateTotalAfterDiscount($totalAmount, $discountValue) {
        $totalAfterDiscount = $totalAmount - $discountValue;
        return $totalAfterDiscount;
    }

}
