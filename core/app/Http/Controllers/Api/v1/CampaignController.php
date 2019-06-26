<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Campaign;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\Campaign as CampaignResource;
use App\Http\Resources\Api\v1\CampaignCollection as CampaignResourceCollection;
use Illuminate\Http\Response;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $campaigns = Campaign::ownBy(auth('api')->id())
            ->status(request()->input('status'))
            ->paginate((intval(request()->limit) > 0)? intval(request()->limit) : 20);

        return response([
            'status' => 20,
            'message' => 'Success',
            'payload' => new CampaignResourceCollection($campaigns)
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return CampaignResource
     * @throws AuthorizationException
     */
    public function store(Request $request)
    {
        $this->authorize('create', Campaign::class);

        $campaign = Campaign::initCampaign($request->only('name', 'note'));

        return response([
                'status' => 20,
                'message' => 'Success',
                'payload' => new CampaignResource($campaign)
            ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param Campaign $campaign
     * @return CampaignResource
     * @throws AuthorizationException
     */
    public function show(Campaign $campaign)
    {
        $this->authorize('view', $campaign);

        return response([
                'status' => 20,
                'message' => 'Success',
                'payload' => new CampaignResource($campaign)
            ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Campaign $campaign
     * @return CampaignResource
     * @throws AuthorizationException
     */
    public function update(Request $request, Campaign $campaign)
    {
        $this->authorize('update', $campaign);

        $campaign->fill($request->only($campaign->fillableProps()));
        $campaign->save();

        return response([
                'status' => 20,
                'message' => 'Success',
                'payload' => new CampaignResource($campaign)
            ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Campaign $campaign
     * @return void
     * @throws AuthorizationException
     */
    public function destroy(Campaign $campaign)
    {
        $this->authorize('delete', $campaign);

        $campaign->delete();

        return response([
                'code' => 20,
                'message' => 'Success'
            ], 200);
    }
}
