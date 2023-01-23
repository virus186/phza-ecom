<?php

namespace App\Http\Controllers\Api\Vendor;

use App\Models\Order;
use App\Models\Dispute;
use App\Models\System;
use App\Http\Controllers\Controller;
use App\Http\Resources\DisputeResource;
use App\Http\Requests\Validations\OrderDetailRequest;
use App\Http\Requests\Validations\ResponseDisputeRequest;
use App\Notifications\SuperAdmin\AppealedDisputeReplied as AppealedDisputeRepliedNotification;
use App\Notifications\SuperAdmin\DisputeAppealed as DisputeAppealedNotification;
use App\Events\Dispute\DisputeUpdated;
use App\Helpers\ListHelper;
use Illuminate\Http\Request;

class DisputeController extends Controller
{

    /**
     * All disoutes
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $disputes = Dispute::mine()->get();

        $disputes = $disputes->paginate(config('mobile_app.view_listing_per_page', 8));

        return DisputeResource::collection($disputes);
    }

    public function show(Request $request, Dispute $dispute)
    {
        // Check Permission

        return new DisputeResource($dispute);
    }

    /**
     * Display the response form.
     *
     * @param Dispute $dispute
     * @return \Illuminate\Http\Response
     */
    public function response(ResponseDisputeRequest $request, Dispute $dispute)
    {
        // $dispute = $this->dispute->find($id);

        try {
            $old_status = $dispute->status;

            $dispute->update($request->all());

            $response = $dispute->replies()->create($request->all());

            if ($request->hasFile('attachments')) {
                $response->saveAttachments($request->file('attachments'));
            }

            $current_status = $response->repliable->status;

            // Send notification to Admin
            if (config('system_settings.notify_when_dispute_appealed') && ($current_status == Dispute::STATUS_APPEALED)) {
                $system = System::orderBy('id', 'asc')->first();

                if ($current_status != $old_status) {
                    $system->superAdmin()->notify(new DisputeAppealedNotification($response));
                } else {
                    $system->superAdmin()->notify(new AppealedDisputeRepliedNotification($response));
                }
            }

            event(new DisputeUpdated($response));
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }

        return response()->json(['message' => trans('api_vendor.dispute_updated_successfully')], 200);
    }
}
