<?php

namespace App\Http\Controllers\Api\DeliveryBoy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeliveryBoyController extends Controller
{
    public function status()
    {
        return (bool) Auth::guard('delivery_boy-api')->user()->status;
    }
}
