<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model {

    public $table = 'orders';
    protected $fillable = [
        'order_id',
        'email',
        'total_amount_net',
        'shipping_costs',
        'payment_method'
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

}
