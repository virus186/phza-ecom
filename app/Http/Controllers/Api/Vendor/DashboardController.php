<?php

namespace App\Http\Controllers\Api\Vendor;

use App\Models\Inventory;
use App\Helpers\ListHelper;
use App\Helpers\Statistics;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderLightResource;
use App\Http\Resources\InventoryLightResource;
use App\Http\Resources\TopSellingItemResource;

class DashboardController extends Controller
{
    /**
     * get basic statistics for vendor dashboard
     */

    public function basicStatistics(Request $request)
    {
        $days = $request->get('latest_in_days') ?? config('charts.latest_sales.days');
        $decimal = config('system_settings.decimals', 2);

        $last_sale = Statistics::last_sale();

        $statistics['data'] = [
            'latest_order_count' => Statistics::latest_order_count($days),
            'unfulfilled_order_count' => Statistics::unfulfilled_order_count(),
            'todays_order_count' => Statistics::todays_order_count(),
            'stock_count' => Statistics::shop_inventories_count(),
            'stock_out_count' => Statistics::stock_out_count(),
            'last_sale_amount' => get_formated_currency($last_sale->grand_total ?? 0, $decimal),
            'todays_sale_amount' => get_formated_currency(Statistics::todays_sale_amount(), $decimal),
            'yesterdays_sale_amount' => get_formated_currency(Statistics::yesterdays_sale_amount(), $decimal),
            'latest_refund_amount' => get_formated_currency(Statistics::latest_refund_total($days), $decimal),
        ];

        return response()->json($statistics, 200);
    }

    /**
     * get latest items for vendor dashboard
     */
    public function latestOrders(Request $request)
    {
        $orders = ListHelper::latest_orders($request->get('limit'));

        return OrderLightResource::collection($orders);
    }

    /**
     * get latest top selling items for vendor dashboard
     */
    public function topSellingItems(Request $request)
    {
        $items = ListHelper::top_listing_items(null, $request->get('limit'));

        return TopSellingItemResource::collection($items);
    }

    /**
     * get out of stock items for vendor dashboard
     */
    public function outOfStocksItems(Request $request)
    {
        $limit = $request->get('limit');

        // Limit can be in between 5 and 100
        $limit = $limit < 5 ? 5 : ($limit > 100 ? 100 : $limit);

        $inventories = Inventory::mine()->stockOut()
            ->with('image:path,imageable_id,imageable_type')
            ->latest()->limit($limit)->get();

        return InventoryLightResource::collection($inventories);
    }
}
