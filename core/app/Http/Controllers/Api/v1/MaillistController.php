<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\Api\v1\Maillist\MaillistUpdateRequest;
use App\Models\Campaign;
use App\Http\Resources\Api\v1\Maillist as MaillistResource;
use Illuminate\Auth\Access\AuthorizationException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class MaillistController extends Controller
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

        $maillist = $campaign->maillist;

        return response([
            'code'      => 20,
            'message'   => 'Success',
            'payload'   => new MaillistResource($maillist)
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param MaillistUpdateRequest $request
     * @param $campaign_id
     * @return Response
     * @throws AuthorizationException
     */
    public function update(MaillistUpdateRequest $request, $campaign_id)
    {
        $campaign = Campaign::findOrFail($campaign_id);
        $this->authorize('update', $campaign);

        $maillist = $campaign->maillist;
        $maillist->fill($request->only('data'));
        $maillist->save();

        return response([
            'code'      => 20,
            'message'   => 'Success',
            'payload'   => new MaillistResource($maillist)
        ], 200);
    }
}
