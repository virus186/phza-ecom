<?php

namespace App\Http\Controllers\Api\Vendor;

use App\Models\Order;
use App\Models\Cancellation;
use App\Http\Controllers\Controller;
use App\Http\Resources\CancelationResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class OrderCancellationController extends Controller
{
    /**
     * All cancellation resquets
     *
     * @return void
     */
    public function index()
    {
        $cancellations = Cancellation::mine()->paginate(config('mobile_app.view_listing_per_page', 8));

        return CancelationResource::collection($cancellations);
    }

    /**
     * Approve cancellation request
     *
     * @param Request $request
     * @param Order $order
     * @return void
     */
    public function approve_request(Request $request, Order $order)
    {
        // Check permission

        try {
            if ($order->cancellation) {
                $order->cancellation->forceFill([
                    'items' => null,
                    'status' => Cancellation::STATUS_APPROVED,
                ])->save();

                return response()->json(['message' => trans('api_vendor.order_updated_successfully')], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }

        return response()->json(['message' => trans('api.something_went_wrong')], 400);
    }

    /**
     * Approve cancellation request
     *
     * @param Request $request
     * @param Order $order
     * @return void
     */
    public function decline_request(Request $request, Order $order)
    {
        // Check permission

        try {
            if ($order->cancellation) {
                $order->cancellation->forceFill([
                    'items' => null,
                    'status' => Cancellation::STATUS_DECLINED,
                ])->save();

                return response()->json(['message' => trans('api_vendor.order_updated_successfully')], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }

        return response()->json(['message' => trans('api.something_went_wrong')], 400);
    }

    /**
     * Cancel order
     *
     * @param OrderDetailRequest $request
     * @param Order $order
     * @return \Illuminate\Http\Response
     */
    public function cancel(Request $request, Order $order)
    {
        try {
            // Need to do, Check how web works
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }

        return response()->json(['message' => trans('api_vendor.order_updated_successfully')], 200);
    }
}
