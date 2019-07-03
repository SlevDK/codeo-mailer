<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\Api\v1\Campaigns\ProxySettingsUpdateRequest;
use App\Models\Campaign;
use App\Http\Resources\Api\v1\CampaignProxySettings as CampaignProxySettingsResource;
use Illuminate\Auth\Access\AuthorizationException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class CampaignProxySettingsController extends Controller
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

        $settings = $campaign->proxySettings;

        return response([
            'code'      => 20,
            'message'   => 'Success',
            'payload'   => new CampaignProxySettingsResource($settings)
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProxySettingsUpdateRequest $request
     * @param $campaign_id
     * @return Response
     * @throws AuthorizationException
     */
    public function update(ProxySettingsUpdateRequest $request, $campaign_id)
    {
        $campaign = Campaign::findOrFail($campaign_id);
        $this->authorize('update', $campaign);

        $settings = $campaign->proxySettings;
        $settings->fill($request->only($settings->fillableProps()));
        $settings->save();

        return response([
            'code'      => 20,
            'message'   => 'Success',
            'payload'   => new CampaignProxySettingsResource($settings)
        ], 200);
    }
}
