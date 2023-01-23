<?php

namespace App\Http\Controllers\Api\Vendor;

use App\Models\User;
use App\Models\System;
use App\Events\Shop\ShopCreated;
use App\Http\Resources\MerchantResource;
use App\Http\Controllers\Controller;
use App\Jobs\CreateShopForMerchant;
use App\Jobs\SubscribeShopToNewPlan;
use App\Notifications\Auth\UserResetPasswordNotification as SendPasswordResetEmail;
use App\Notifications\Auth\SendVerificationEmail as EmailVerificationNotification;
use App\Notifications\User\PasswordUpdated as PasswordResetSuccess;
use App\Notifications\SuperAdmin\VerdorRegistered as VerdorRegisteredNotification;
use App\Http\Requests\Validations\RegisterMerchantRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

// use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Carbon\Carbon;

class AuthController extends Controller
{
    /**
     * Register as menchant
     *
     * @param RegisterMerchantRequest $request
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterMerchantRequest $request)
    {
        $phone = Str::start(trim($request->phone), '+');

        if (is_incevio_package_loaded('otp-login')) {
            send_otp_code($phone);
        }

        $data = $request->all();
        $data['phone'] = $phone;

        $merchant = $this->create($data);

        DB::beginTransaction();

        try {
            $merchant->generateToken();

            // Dispatching Shop create job
            CreateShopForMerchant::dispatch($merchant, $data);

            if (is_incevio_package_loaded('otp-login')) {
                Auth::guard()->login($merchant);
            }

            if (is_subscription_enabled()) {
                SubscribeShopToNewPlan::dispatch($merchant, $request->input('plan'));
            }
        } catch (\Exception $e) {

            // rollback the transaction and log the error
            DB::rollback();
            Log::error('Vendor Registration Failed: ' . $e->getMessage());

            // Set error messages:
            $error = new MessageBag();
            $error->add('errors', trans('responses.vendor_config_failed'));

            return response()->json($error);
        }

        // Everything is fine. Now commit the transaction
        DB::commit();

        // Trigger after registration events
        $this->triggerAfterEvents($merchant);

        // Send notification to Admin
        if (config('system_settings.notify_when_vendor_registered')) {
            $system = System::orderBy('id', 'asc')->first();
            $system->superAdmin()->notify(new VerdorRegisteredNotification($merchant));
        }

        return new MerchantResource($merchant);
    }

    /**
     * Merchant login
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if (is_incevio_package_loaded('otp-login') && $request->has('phone')) {
            $phone = Str::start(trim($request->phone), '+');

            if (!User::where('phone', $phone)->exists()) {
                return response()->json(['message' => trans('otp-login::lang.not_registered')], 302);
            }

            try {
                send_otp_code($phone, null);
            } catch (\Exception $e) {
                return response()->json(['message' => trans('otp-login::lang.phone_session_expired')], 302);
            }

            return response()->json(['message' => trans('otp-login::lang.verification_code_sent')], 200);
        }

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::guard('vendor')->attempt($credentials)) {
            $merchant = Auth::guard('vendor')->user();

            $merchant->generateToken();

            return new MerchantResource($merchant);
        }

        return response()->json(['message' => trans('api.auth_failed')], 401);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\Models\User
     */
    protected function create(array $request_data)
    {
        $data = [
            'email' => $request_data['email'],
            'password' => bcrypt($request_data['password']),
            'verification_token' => Str::random(40),
        ];

        if (is_incevio_package_loaded('otp-login')) {
            $data['phone'] = $request_data['phone'];
        }

        return User::create($data);
    }

    /**
     * Trigger some events after a valid registration.
     *
     * @param User $merchant
     * @return void
     */
    protected function triggerAfterEvents(User $merchant)
    {
        // Trigger the systems default event
        event(new \Illuminate\Auth\Events\Registered($merchant));

        // Trigger shop created event
        event(new ShopCreated($merchant->owns));

        // Send email verification notification
        $merchant->notify(new EmailVerificationNotification($merchant));
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $user = Auth::guard('vendor_api')->user();

        if ($user) {
            $user->api_token = null;
            $user->save();
        }

        return response()->json(trans('api.auth_out'), 200);
    }

    /** reset password link send
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function forgot(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => trans('api.email_account_not_found')], 404);
        }

        $token = Str::random(60);
        $url = url('/password/reset/' . $token);

        $passwordReset = DB::table('password_resets')
            ->updateOrInsert(
                ['email' => $user->email],
                [
                    'email' => $user->email,
                    'token' => $token,
                    'created_at' => Carbon::now(),
                ]
            );

        if ($user && $passwordReset) {
            $user->notify(new SendPasswordResetEmail($token, $url));
        }

        return response()->json(['message' => trans('api.password_reset_link_sent')], 201);
    }

    /**
     * Find token password reset
     *
     * @param  [string] $token
     * @return [string] message
     * @return [json] passwordReset object
     */
    public function token($token)
    {
        $passwordReset = DB::table('password_resets')
            ->where('token', $token)->first();

        if (!$passwordReset) {
            return response()->json([
                'message' => trans('api.password_reset_token_404')
            ], 404);
        }

        if (Carbon::parse($passwordReset->created_at)->addMinutes(720)->isPast()) {
            DB::table('password_resets')->where('token', $token)->delete();

            return response()->json([
                'message' => trans('api.password_reset_token_invalid')
            ], 404);
        }

        return response()->json($passwordReset);
    }

    /**
     * Reset password
     *
     * @param  [string] password
     * @param  [string] password_confirmation
     * @param  [string] token
     * @return [string] message
     */
    public function reset(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:6|confirmed',
            'token' => 'required|string',
        ]);

        $passwordReset = DB::table('password_resets')
            ->where('token', $request->token)->first();

        if (!$passwordReset) {
            return response()->json([
                'message' => trans('api.password_reset_token_404')
            ], 404);
        }

        $user = User::where('email', $passwordReset->email)->first();
        if (!$user) {
            return response()->json([
                'message' => trans('api.email_account_not_found')
            ], 404);
        }

        $user->password = bcrypt($request->password);
        $user->save();

        DB::table('password_resets')->where('token', $request->token)->delete();

        $user->notify(new PasswordResetSuccess($user));

        return response()->json([
            'message' => trans('api.password_reset_successful')
        ], 200);
    }
}
