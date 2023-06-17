<?php

namespace App\Http\Controllers;

use App\Contracts\PaymentServiceContract as PaymentGateway;
use App\Exceptions\PaymentFailedException;
use App\Http\Requests\CreatePaymentRequest;
use App\Models\Order;
use App\Models\PaymentToken;
use App\Services\Payments\PaymentService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function create(CreatePaymentRequest $request, PaymentGateway $payment)
    {

        DB::beginTransaction();

        try {
            // Create the order
            $order = PaymentToken::whereToken($request->token)->first();

            $receiver = 'platform';

            if ($order) {

                $response = $payment->setReceiver($receiver)
                    ->setOrderInfo($order)
                    ->setAmount($order->total_amount)
                    ->setDescription(trans('app.purchase_from', [
                        'marketplace' => get_platform_title()
                    ]))
                    ->setConfig()
                    ->charge();

                // Check if the response needs to redirect to gateways
                if ($response instanceof RedirectResponse) {
                    DB::commit();

                    return $response;
                }

                switch ($response->status) {
                    case PaymentService::STATUS_PAID:
                        $order->markAsPaid();
                        // Order has been paid
                        $order->order_status_id = Order::STATUS_CONFIRMED;
                        $order->payment_status = Order::PAYMENT_STATUS_PAID;
                        break;

                    case PaymentService::STATUS_PENDING:
                        $order->order_status_id = Order::STATUS_WAITING_FOR_PAYMENT;
                        $order->payment_status = Order::PAYMENT_STATUS_PENDING;

                        break;

                    case PaymentService::STATUS_ERROR:
                        $order->payment_status = Order::PAYMENT_STATUS_PENDING;
                        $order->order_status_id = Order::STATUS_PAYMENT_ERROR;
                    default:
                        throw new PaymentFailedException(trans('theme.notify.payment_failed'));
                }
            } else {
                throw new Exception('Not Valid Payment Link');
            }
            // Save the order
            $order->save();
        } catch (\Exception $e) {
            DB::rollback(); // rollback the transaction and log the error

            Log::error($request->payment_method . ' payment failed:: ' . $e->getMessage());
            Log::error($e);

            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }

        // Everything is fine. Now commit the transaction
        DB::commit();

        // Trigger the Event
        // event(new OrderCreated($order));

        return view('theme::order_complete', compact('order'))
            ->with('success', trans('theme.notify.order_placed'));
    }
}
