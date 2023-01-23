<?php

namespace App\Http\Controllers\Api\Vendor;

use App\Models\Refund;
use App\Common\Authorizable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Events\Refund\RefundApproved;
use App\Events\Refund\RefundDeclined;
use App\Events\Refund\RefundInitiated;
use App\Http\Resources\RefundResource;
use App\Repositories\Refund\RefundRepository;
use App\Http\Requests\Validations\InitiateRefundRequest;

class RefundController extends Controller
{
    //use Authorizable;

    private $model_name;

    private $refund;

    /**
     * construct
     */
    public function __construct(RefundRepository $refund)
    {
        parent::__construct();

        $this->model_name = trans('app.model.refund');

        $this->refund = $refund;
    }

    /**
     * Display open listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($status = 'open')
    {
        $refunds =  Refund::mine();

        // When the orders need to filter
        switch ($status) {
            case 'closed':
                $refunds = $refunds->closed();
                break;

            case 'open':
            default:
                $refunds = $refunds->open();
                break;
        }

        return RefundResource::collection($refunds->get());
    }

    /**
     * Display the specified resource.
     *
     * @param  Refund  $refund
     * @return \Illuminate\Http\Response
     */
    public function show(Refund $refund)
    {
        return new RefundResource($refund);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function initiate(InitiateRefundRequest $request)
    {
        // Start transaction!
        DB::beginTransaction();

        try {
            $refund = $this->refund->store($request);

            $this->refund_to_wallet($refund);

            event(new RefundInitiated($refund, $request->filled('notify_customer')));
        } catch (\Exception $e) {
            \Log::error($e);        // Log the error

            DB::rollback();         // rollback the transaction and log the error

            return response()->json(['message' => $e->getMessage()], 400);
        }

        DB::commit();           // Everything is fine. Now commit the transaction

        return response()->json(['message' => trans('api_vendor.refund_has_been_created_successfully')], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function response($id)
    {
        $refund = $this->refund->find($id);

        return  new RefundResource($refund);
    }

    public function approve(Request $request, $id)
    {

        $refund = $this->refund->approve($id);


        $this->refund_to_wallet($refund);

        event(new RefundApproved($refund, $request->filled('notify_customer')));

        return response()->json(['message' => trans('api_vendor.refund_updated_successfully')]);
    }

    public function decline(Request $request, $id)
    {
        $refund = $this->refund->decline($id);

        event(new RefundDeclined($refund, $request->filled('notify_customer')));

        return response()->json(['message' => trans('api_vendor.refund_updated_successfully')]);
    }

    private function refund_to_wallet($refund)
    {
        if ($refund->isApproved() && $refund->order->customer_id && customer_has_wallet()) {
            $wallet = new \Incevio\Package\Wallet\Services\RefundToWallet();

            return $wallet->sender($refund->shop)
                ->receiver($refund->order->customer)
                ->amount($refund->amount)
                ->meta([
                    'type' => trans('wallet::lang.refund'),
                    'description' => trans('wallet::lang.refund_of', ['order' => $refund->order->order_number]),
                ])
                ->forceTransfer()
                ->execute();
        }
    }
}
