<?php

namespace App\Http\Controllers\Api\Vendor;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Events\User\UserUpdated;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Events\Profile\PasswordUpdated;
use App\Http\Resources\ProfileResource;
use App\Repositories\Account\AccountRepository;
use App\Http\Requests\Validations\UpdatePhotoRequest;
use App\Http\Requests\Validations\UpdateProfileRequest;
use App\Http\Requests\Validations\SelfPasswordUpdateRequest;

class AccountController extends Controller
{
    private $profile;

    /**
     * construct
     */
    public function __construct(AccountRepository $profile)
    {
        parent::__construct();

        $this->profile = $profile;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $profile = $this->profile->profile();

        return new ProfileResource($profile);
    }

    /**
     * Update user profile
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfileRequest $request)
    {
        if (
            config('app.demo') == true &&
            Auth::guard('vendor_api')->user()->id <= config('system.demo.users')
        ) {
            return response()->json(['message' => trans('messages.demo_restriction')], 400);
        }

        try {
            $user = User::where('id', Auth::guard('vendor_api')->user()->id)->first();

            $user->update($request->all());

            event(new UserUpdated(Auth::guard('vendor_api')->user()));
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }

        return response()->json(['message' => trans('api_vendor.account_updated_successfully')], 200);
    }

    /**
     * Update user profile
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update_avatar(UpdatePhotoRequest $request)
    {
        try {
            $this->profile->updatePhoto($request);

            event(new UserUpdated(Auth::guard('vendor_api')->user()));
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }

        return response()->json(['message' => trans('api_vendor.profile_picture_updated_successfully')], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function password_update(SelfPasswordUpdateRequest $request)
    {
        if (
            config('app.demo') == true &&
            Auth::guard('vendor_api')->user()->id <= config('system.demo.users')
        ) {
            return response()->json(['message' => trans('messages.demo_restriction')], 400);
        }

        try {
            $user = User::where('id', Auth::guard('vendor_api')->user()->id)->first();

            $user->update($request->all());

            event(new PasswordUpdated(Auth::guard('vendor_api')->user()));
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }

        return response()->json(['message' => trans('api_vendor.account_updated_successfully')], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        if (
            config('app.demo') == true &&
            Auth::guard('vendor_api')->user()->id <= config('system.demo.users')
        ) {
            return response()->json(['message' => trans('messages.demo_restriction')], 400);
        }

        try {
            $this->profile->delete($request);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }

        return response()->json(['message' => trans('api_vendor.aaccount_deleted_successfully')], 200);
    }
}
