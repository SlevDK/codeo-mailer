<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\Api\v1\Campaigns\RandomizerSettingsUpdateRequest;
use App\Http\Resources\Api\v1\CampaignRandomizerSettings as CampaignRandomizerSettingsResource;
use App\Models\Campaign;
use Illuminate\Auth\Access\AuthorizationException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class CampaignRandomizerSettingsController extends Controller
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

        $settings = $campaign->randomizerSettings;

        return response([
            'code'      => 20,
            'message'   => 'Success',
            'payload'   => new CampaignRandomizerSettingsResource($settings)
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RandomizerSettingsUpdateRequest $request
     * @param $campaign_id
     * @return Response
     * @throws AuthorizationException
     */
    public function update(RandomizerSettingsUpdateRequest $request, $campaign_id)
    {
        $campaign = Campaign::findOrFail($campaign_id);
        $this->authorize('update', $campaign);

        $settings = $campaign->randomizerSettings;
        $settings->fill($request->only($settings->fillableProps()));
        $settings->save();

        return response([
            'code'      => 20,
            'message'   => 'Success',
            'payload'   => new CampaignRandomizerSettingsResource($settings)
        ], 200);
    }
}
