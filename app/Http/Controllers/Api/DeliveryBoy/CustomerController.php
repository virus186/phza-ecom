<?php

namespace App\Http\Controllers\Api\DeliveryBoy;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderLightResource;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function contact($orderId)
    {
        $order = Order::select('id', 'order_number', 'customer_id', 'billing_address', 'shipping_address')
            ->where('delivery_boy_id', Auth::guard('delivery_boy-api')->user()->id)
            ->where('id', $orderId)
            ->first();

        // Need to create Resource as requirement
        return $order;
    }
}
