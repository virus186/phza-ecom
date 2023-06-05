<?php

namespace App\Services\Payments;

use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Http\Request;

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

        $this->setStripeToken();

        return $this;
    }

    public function charge()
    {
        $enablePayment = env('THIRD_PARTY_PAYMENT_ENABLE', true);

        $transaction = Transaction::create([
            'transaction_ID' => $this->order->order_number,
            'member_id' => auth()->user()->id,
            'transaction_type' => TRANSFER_OUT,
            'currency_id' => $currencyId,
            'amount' => $orderAmount,
            'third_party_amount' => $orderAmount,
            'status' => $enablePayment == true ? "Pending" : "Success",
            'message' => "{{Payment transaction}}",
        ]);


        $dataPayment['payment_id']  = rand();
        $dataPayment['customer_id'] = Auth()->user()->id;
        $dataPayment['amount']      = $this->amount;
        $dataPayment['order_product_ids'] = $this->getOrderId();
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
                "total_amount" => get_cent_from_doller($this->amount),
                "currency" => get_currency_code(),
                "notify_url" => url('/') . '/api/transactions/deposit-response',
                "expires_in" => 3600,
                "login_type" => "ANONYMOUS"
            ];
            $data['sign'] = signature($data, getConfigs()['api_secret_key']);
            $url = getConfigs()['url'] . '/api/mch/v2/gateway';

            $result = callHttp($url, $data);
            if (@$result['success'] == true) {
                $this->link = @$result['data']['payment_link'];
                $this->status = self::STATUS_PAID;

                //  return redirect(@$resp['data']['payment_link']);
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

    private function setStripeToken()
    {
        $this->token = getToken();
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
            'shipping_address' => strip_tags($order->shipping_address),
            'buyer_note' => $order->buyer_note,
        ];

        return $this;
    }

    private function setStripAccountId()
    {
        if ($this->order && $this->receiver == 'merchant') {
            $this->stripe_account_id = $this->order->shop->config->stripe->stripe_user_id;
        } else {
            $this->stripe_account_id = config('services.stripe.account_id');
        }
    }

    private function chargeSavedCustomer()
    {
        return $this->payee && $this->payee->hasBillingToken() &&
            ($this->request->has('remember_the_card') ||
                $this->request->payment_method == 'saved_card');
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
