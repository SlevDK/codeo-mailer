<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\Api\v1\Campaigns\FromEmailSettingsUpdateRequest;
use App\Http\Resources\Api\v1\CampaignAdditionalSettings as CampaignAdditionalSettingsResource;
use App\Models\Campaign;
use Illuminate\Auth\Access\AuthorizationException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class CampaignAdditionalSettingsController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param $campaign_id
     * @return Response
     * @throws AuthorizationException
     */
    public function show($campaign_id)
    {
        $campaign = Campaign::findOrFail($campaign_id);
        $this->authorize('view', $campaign);

        $settings = $campaign->additionalSettings;

        return response([
            'code'      => 20,
            'message'   => 'Success',
            'payload'   => new CampaignAdditionalSettingsResource($settings)
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param FromEmailSettingsUpdateRequest $request
     * @param $campaign_id
     * @return Response
     * @throws AuthorizationException
     */
    public function update(FromEmailSettingsUpdateRequest $request, $campaign_id)
    {
        $campaign = Campaign::findOrFail($campaign_id);
        $this->authorize('update', $campaign);

        $settings = $campaign->additionalSettings;
        $settings->fill($request->only($settings->fillableProps()));
        $settings->save();

        return response([
            'code'      => 20,
            'message'   => 'Success',
            'payload'   => new CampaignAdditionalSettingsResource($settings)
        ], 200);
    }
}
