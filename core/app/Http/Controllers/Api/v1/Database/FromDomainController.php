<?php

namespace App\Http\Controllers\Api\v1\Database;

use App\Http\Requests\Api\v1\Database\FromDomainStoreRequest;
use App\Http\Requests\Api\v1\Database\FromDomainUpdateRequest;
use App\Http\Requests\Api\v1\Database\HeaderUpdateRequest;
use App\Http\Resources\Api\v1\Database\FromDomainCollection as DatabaseFromDomainCollectionResource;
use App\Http\Resources\Api\v1\Database\FromDomainData as DatabaseFromDomainDataResource;
use App\Models\Database\FromDomain;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class FromDomainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $headers = FromDomain::ownBy(auth('api')->id())
            ->paginate((intval(request()->limit) > 0)? intval(request()->limit) : 20);

        return response([
            'status' => 20,
            'message' => 'Success',
            'payload' => new DatabaseFromDomainCollectionResource($headers)
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param FromDomainStoreRequest $request
     * @return Response
     * @throws AuthorizationException
     */
    public function store(FromDomainStoreRequest $request)
    {
        $this->authorize('create', FromDomain::class);

        $header = FromDomain::initFromDomain($request->only('name'));

        return response([
            'code'      => 20,
            'message'   => 'Success',
            'payload'   => new DatabaseFromDomainDataResource($header)
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param FromDomain $fromDomain
     * @return Response
     * @throws AuthorizationException
     */
    public function show(FromDomain $fromDomain)
    {
        $this->authorize('view', $fromDomain);

        return response([
            'code'      => 20,
            'message'   => 'Success',
            'payload'   => new DatabaseFromDomainDataResource($fromDomain)
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param FromDomainUpdateRequest $request
     * @param FromDomain $fromDomain
     * @return Response
     * @throws AuthorizationException
     */
    public function update(FromDomainUpdateRequest $request, FromDomain $fromDomain)
    {
        $this->authorize('update', $fromDomain);

        $fromDomain->fill($request->only(['name', 'data']));
        $fromDomain->save();

        return response([
            'code'      => 20,
            'message'   => 'Success',
            'payload'   => new DatabaseFromDomainDataResource($fromDomain)
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param FromDomain $fromDomain
     * @return Response
     * @throws AuthorizationException
     */
    public function destroy(FromDomain $fromDomain)
    {
        $this->authorize('delete', $fromDomain);

        $fromDomain->delete();

        return response([
            'code'      => 20,
            'message'   => 'Success',
        ], 200);
    }
}
