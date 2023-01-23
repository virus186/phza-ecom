<?php

namespace App\Http\Controllers\Api\DeliveryBoy;

use App\Http\Controllers\Controller;
use App\Http\Resources\ShopLightResource;
use App\Models\DeliveryBoy;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function index()
    {
        $shopId = DeliveryBoy::findOrFail(Auth::guard('delivery_boy-api')->user()->id)->shop_id;

        $shopDetails = Shop::findOrFAil($shopId);

        return new ShopLightResource($shopDetails);
    }
}
