<?php

namespace App\Http\Controllers\Api\Vendor;

use App\Models\Shop;
use App\Models\Config;
// use App\Common\Authorizable;
use App\Events\Shop\ShopIsLive;
use App\Events\Shop\ShopUpdated;
use App\Events\Shop\ConfigUpdated;
use App\Http\Controllers\Controller;
use App\Events\Shop\DownForMaintainace;
use App\Http\Resources\ShopSettingResource;
use App\Http\Requests\Validations\UpdateConfigRequest;
use App\Http\Requests\Validations\MerchantVerifyRequest;
use App\Http\Requests\Validations\UpdateBasicConfigRequest;
use App\Http\Requests\Validations\ToggleMaintenanceModeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConfigController extends Controller
{
    // use Authorizable;

    private $model_name;

    /**
     * construct
     */
    public function __construct()
    {
        parent::__construct();

        $this->model_name = trans('app.model.config');
    }

    /**
     * Display the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $shop = Auth::user()->shop;

        return new ShopSettingResource($shop);
    }

    /**
     * Display the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function configs()
    {
        // Check permission

        $config = Config::findOrFail(Auth::user()->merchantId());

        return response()->json($config);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $shop_id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBasicConfigRequest $request, $shop_id)
    {
        // Check permission

        $shop = Shop::findOrFail($shop_id);

        $shop->update($request->all());

        if ($request->hasFile('logo') || ($request->input('delete_logo') == 1)) {
            $shop->deleteLogo();
        }

        if ($request->hasFile('logo')) {
            $shop->saveImage($request->file('logo'), 'logo');
        }

        if ($request->hasFile('cover_image') || ($request->input('delete_cover_image') == 1)) {
            $shop->deleteCoverImage();
        }

        if ($request->hasFile('cover_image')) {
            $shop->saveImage($request->file('cover_image'), 'cover');
        }

        event(new ShopUpdated($shop));

        return response()->json(['message' => trans('api_vendor.config_updated_successfully')], 200);
    }

    /**
     * Update shop configs
     *
     * @param UpdateConfigRequest $request
     * @param [type] $config
     * @return void
     */
    public function updateConfigs(Request $request, $config)
    {
        $settings = Config::findOrFail($config);

        // Check permission

        if ($settings->update($request->all())) {
            event(new ConfigUpdated($settings->shop, Auth::user()));

            return response()->json(['message' => trans('api_vendor.config_updated_successfully')]);
        }

        return response('error', 405);
    }

    /**
     * Display the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function verify(MerchantVerifyRequest $request)
    {
        $config = Config::findOrFail(Auth::user()->merchantId());

        return view('admin.config.verify', compact('config'));
    }

    /**
     * Display the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function saveVerificationData(MerchantVerifyRequest $request)
    // {
    //     $config = Config::findOrFail(Auth::user()->merchantId());

    //     if ($request->hasFile('documents')) {
    //         $config->saveAttachments($request->file('documents'));
    //     }

    //     $config->update(['pending_verification' => 1]);

    //     return response()->json(['message' => trans('messages.updated', ['model' => $this->model_name])], 200);
    // }

    /**
     * Toggle Maintenance Mode of the given id, Its uses the ajax middleware
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $node
     * @return \Illuminate\Http\Response
     */
    public function toggleNotification(Request $request, $node)
    {
        $config = Config::findOrFail($request->user()->merchantId());

        if (config('app.demo') == true && $config->shop_id <= config('system.demo.shops', 2)) {
            return response('error', 444);
        }

        //$this->authorize('update', $config); // Check permission

        $config->$node = !$config->$node;

        if ($config->save()) {
            event(new ConfigUpdated($config->shop, Auth::user()));

            return response('success', 200);
        }

        return response('error', 405);
    }

    /**
     * Toggle Maintenance Mode of the given id, Its uses the ajax middleware
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function toggleMaintenanceMode(ToggleMaintenanceModeRequest $request, $id)
    {
        if (config('app.demo') == true && $id <= config('system.demo.shops', 2)) {
            return response('error', 444);
        }

        $config = Config::findOrFail($id);

        // $this->authorize('update', $config); // Check permission

        $config->maintenance_mode = !$config->maintenance_mode;

        if ($config->save()) {
            if ($config->maintenance_mode) {
                event(new DownForMaintainace($config->shop));
            } else {
                event(new ShopIsLive($config->shop));
            }

            return response('success', 200);
        }

        return response('error', 405);
    }
}
