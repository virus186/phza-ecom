<?php

namespace App\Http\Controllers\Api\Vendor;

use App\Http\Resources\NotificationResource;
use App\Models\User;
use App\Services\FCMService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function saveToken(Request $request)
    {
        $user = Auth::user();
        $user->fcm_token = $request->token;
        $user->save();

        return response()->json(['message' => 'Token saved successfully'], 200);
    }

    public function getNotifications()
    {
        $notifications =  auth()->user()->shop->notifications;

        return NotificationResource::collection($notifications);
        //return new NotificationResource($notifications);
    }
}
