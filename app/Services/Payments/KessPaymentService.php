<?php

namespace App\Services\Payments;

use App\Models\Customer;
use App\Models\Payment;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class KessPaymentService extends PaymentService
{
    public $stripe_account_id;
    public $token;
    public $card;
    public $fee;
    public $meta;
    public $link;

    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function setConfig()
    {

        // $this->setStripeToken();

        return $this;
    }

    public function charge()
    {
        $enablePayment = env('THIRD_PARTY_PAYMENT_ENABLE', true);



        $transaction = Transaction::create([
            'transaction_ID' => $this->order->order_number,
            'member_id' => $this->payee->id,
            'transaction_type' => 'transfer_out',
            'currency_id' => get_currency_code(),
            'amount' => get_cent_from_doller($this->amount),
            'third_party_amount' => get_cent_from_doller($this->amount),
            'status' => $enablePayment == true ? "Pending" : "Success",
            'message' => "{{Payment transaction}}",
        ]);


        $dataPayment['payment_id']  = rand();
        $dataPayment['customer_id'] = $this->payee->id;
        $dataPayment['amount']      = $this->amount;
        $dataPayment['order_product_ids'] = $this->order->id;
        $dataPayment['transaction_id']      = !empty($transaction->id) ? $transaction->id : 1;
        $dataPayment['provider']    = $enablePayment == true ? 'KES' : 'test';
        $dataPayment['status']      = $enablePayment == true ? 'pending' : 'complete';
        $dataPayment['payment_type'] = 'p';
        $payment = Payment::create($dataPayment);


        if ($enablePayment) {
            $data = [
                'description' => $this->description,
                'metadata' => $this->meta,
                "service" => "webpay.acquire.createOrder",
                "sign_type" => "MD5",
                "seller_code" => getConfigs()['seller_code'],
                "out_trade_no" => $this->order->order_number,
                "body" => "Payment against purchase order",
                "total_amount" => $this->amount,
                "currency" => get_currency_code(),
                "notify_url" => url('/') . '/api/paymentSuccess/5/' . $this->order->id,
                "expires_in" => getConfigs()['expire_at'],
                "login_type" => "ANONYMOUS"
            ];
            $data['sign'] = signature($data, getConfigs()['api_secret_key']);
            $url = getConfigs()['url'] . '/api/mch/v2/gateway';

            $result = callHttp($url, $data);
            if (@$result['success'] == true) {
                $this->link = @$result['data']['payment_link'];
                $this->status = self::STATUS_PENDING;

                return redirect()->to(@$result['data']['payment_link']);
            } else {
                $paymentFail = true;
                $this->status = self::STATUS_ERROR;
            }
        }

        return $this;
    }

    public function setPlatformFee($fee = 0)
    {
        $this->fee = $fee > 0 ? get_cent_from_doller($fee) : 0;

        return $this;
    }

    public function setOrderInfo($order)
    {
        $this->order = $order;

        // If multiple orders take the info from last one
        if (is_array($this->order)) {
            $order = reset($order);
        }

        $this->meta = [
            'order_number' => $order->order_number,
            // 'shipping_address' => strip_tags($order->shipping_address),
            // 'buyer_note' => $order->buyer_note,
        ];

        return $this;
    }

    /* Set the card info */
    public function setCardInfo()
    {
        $this->card = [
            'number' => $this->request->card_number,
            'exp_month' => $this->request->exp_month,
            'exp_year' => $this->request->exp_year,
            'cvc' => $this->request->cvc,
        ];
    }
}
