<?php
/*
* Copyright (C) Incevio Systems, Inc - All Rights Reserved
* Unauthorized copying of this file, via any medium is strictly prohibited
* Proprietary and confidential
* Written by Munna Khan <help.Phza24@gmail.com>, September 2018
*/

namespace App\Http\Middleware;

use App\Models\Customer;
use App\Helpers\ListHelper;
use Closure;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class InitSettings
{
    public function handle($request, Closure $next)
    {
        if (!$request->is("\x69\156\x73\164\x61\x6c\x6c\x2a")) {
            goto NeO0Y;
        }
        return $next($request);
        NeO0Y:
        setSystemConfig();
        View::addNamespace("\164\150\x65\155\x65", theme_views_path());
        if (!Auth::guard("\x77\x65\142")->check()) {
            goto RVzaT;
        }
        if (!$request->session()->has("\151\x6d\160\145\x72\x73\x6f\156\x61\x74\x65\144")) {
            goto KeH8i;
        }
        Auth::onceUsingId($request->session()->get("\x69\x6d\160\145\162\163\x6f\x6e\x61\164\x65\x64"));
        KeH8i:
        if ($request->is("\141\144\x6d\151\156\57\52") || $request->is("\x61\143\143\x6f\x75\156\164\x2f\52")) {
            goto bivNl;
        }
        return $next($request);
        goto SFFix;
        bivNl:
        $this->can_load();
        SFFix:
        $user = Auth::guard("\167\145\142")->user();
        if (!(!$user->isFromPlatform() && $user->merchantId())) {
            goto Bnjly;
        }
        setShopConfig($user->merchantId());
        Bnjly:
        $permissions = Cache::remember("\160\x65\x72\x6d\151\163\x73\x69\157\156\163\x5f" . $user->id, system_cache_remember_for(), function () {
            return ListHelper::authorizations();
        });
        $permissions = isset($extra_permissions) ? array_merge($extra_permissions, $permissions) : $permissions;
        config()->set("\160\x65\162\155\x69\163\163\151\x6f\156\163", $permissions);
        if (!$user->isSuperAdmin()) {
            goto Z1uI5;
        }
        $slugs = Cache::remember("\x73\154\165\147\x73", system_cache_remember_for(), function () {
            return ListHelper::slugsWithModulAccess();
        });
        config()->set("\141\165\x74\150\x53\x6c\x75\x67\x73", $slugs);
        Z1uI5:
        RVzaT:
        return $next($request);
    }
    private function can_load()
    {
        if (!(PHZA24_MIX_KEY != "\x30\61\x37\142\x66\x38\142\x63\x38\x38\x35\x66\142\63\x37\x62" || md5_file(base_path() . "\x2f\142\x6f\157\164\163\164\x72\141\x70\x2f\141\x75\164\x6f\154\x6f\x61\144\x2e\160\x68\x70") != "\x63\x66\66\65\x33\62\61\x65\x65\x66\x63\142\x61\65\x62\71\x35\x34\x30\x37\x61\x31\60\x32\x37\143\x62\67\x62\142\146\67")) {
            goto QFQql;
        }
        die("\104\151\x64\x20\171\157\165\40" . "\x72\145\x6d\157\166\x65\x20\x74\x68\x65\x20" . "\157\x6c\x64\40\146\151\x6c\145\163\40" . "\41\77");
        QFQql:
        incevioAutoloadHelpers(getMysqliConnection());
    }
}
