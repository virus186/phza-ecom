<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::DASHBOARD;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:web')->except('logout');

        $this->middleware('guest:customer')->except('logout');
    }

    public function showAdminLoginForm()
    {
        return view('auth.admin_login');
    }

    public function login(Request $request)
    {
        if (is_incevio_package_loaded('otp-login') && $request->input('phone')) {
            $this->validate($request, [
               'phone' => 'required',
            ]);

            if (!User::where('phone', $request->input('phone'))->exists()) {
                return redirect()->route('login')
                    ->withErrors([trans('otp-login::lang.not_registered')]);
            }

            try {
                send_otp_code($request['phone'], 'login');
            } catch (\Exception $e) {
                return redirect()->route('customer.login')
                    ->withErrors([trans('otp-login::lang.phone_session_expired')]);
            }

            return redirect()->route('vendor.phoneverification.notice')
                ->with(['phone_number' => $request['phone']]);
        }

        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }


        if ($this->attemptLogin($request)) {
            if(auth()->user()->isFromMerchant() && is_incevio_package_loaded('otp-login')){
                // Clear permissions cache for user
                $user = Auth::guard('web')->user();
                if ($user) {
                    Cache::forget('permissions_' . $user->id);
                }

            }


            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }

            return $this->sendLoginResponse($request);

        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);


    }


    /**
     * Log the user out of the application.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        // Clear permissions cache for user
        $user = Auth::guard('web')->user();
        if ($user) {
            Cache::forget('permissions_' . $user->id);
        }

        Auth::guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect($this->redirectTo);
    }


}
