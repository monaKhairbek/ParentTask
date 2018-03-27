<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\OrderItems;
use Helper;

class OrdersController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        //
    }

    public function postOrder(Request $request) {
        
        $orderRequest = $request['parameters']['order'];
        $order = Orders::create([
                    'order_id' => $orderRequest['order_id'],
                    'email' => $orderRequest['email'],
                    'total_amount_net' => $orderRequest['total_amount_net'],
                    'shipping_costs' => $orderRequest['shipping_costs'],
                    'payment_method' => $orderRequest['payment_method']
        ]);


        $statusCode = 422;
        
        if ($order) {
            
            $order->discount_percentage = $order->calculateDiscountPercentage();
            $order->discount_value = $order->calculateDiscountValue($order->total_amount_net);
            $order->total_after_discount = $order->calculateTotalAfterDiscount($order->total_amount_net, $order->discount_value);
            $order->save();
            $items = $orderRequest['items'];
            
            if ($items) {
                foreach($items as $item) {
                    OrderItems::create([
                        'order_id' => $order->id,
                        'name' => $item['name'],
                        'qnt' => $item['qnt'],
                        'value' => $item['value'],
                        'category' => $item['category'],
                        'subcategory' => $item['subcategory'],
                        'collection_id' => $item['collection_id'],
                    ]);
                }
            }
            $statusCode = 200;
        }

        return response(
                [
            'data' => $order,
            'status' => $order ? "success" : "error",
                ], $statusCode
        );
    }

}
