<?php

namespace App\Http\Controllers\Api\v1\Database;

use App\Http\Requests\Api\v1\Database\ProxyStoreRequest;
use App\Http\Requests\Api\v1\Database\ProxyUpdateRequest;
use App\Http\Resources\Api\v1\Database\ProxyCollection as DatabaseProxyCollectionResource;
use App\Http\Resources\Api\v1\Database\ProxyData as DatabaseProxyDataResource;
use App\Models\Database\Proxy;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class ProxyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $proxies = Proxy::ownBy(auth('api')->id())
            ->paginate((intval(request()->limit) > 0)? intval(request()->limit) : 20);

        return response([
            'status' => 20,
            'message' => 'Success',
            'payload' => new DatabaseProxyCollectionResource($proxies)
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProxyStoreRequest $request
     * @return Response
     * @throws AuthorizationException
     */
    public function store(ProxyStoreRequest $request)
    {
        $this->authorize('create', Proxy::class);

        $proxy = Proxy::initProxy($request->only('name'));

        return response([
            'code'      => 20,
            'message'   => 'Success',
            'payload'   => new DatabaseProxyDataResource($proxy)
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param Proxy $proxy
     * @return Response
     * @throws AuthorizationException
     */
    public function show(Proxy $proxy)
    {
        $this->authorize('view', $proxy);

        return response([
            'code'      => 20,
            'message'   => 'Success',
            'payload'   => new DatabaseProxyDataResource($proxy)
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProxyUpdateRequest $request
     * @param Proxy $proxy
     * @return Response
     * @throws AuthorizationException
     */
    public function update(ProxyUpdateRequest $request, Proxy $proxy)
    {
        $this->authorize('update', $proxy);

        $proxy->fill($request->only(['name', 'data']));
        $proxy->save();

        return response([
            'code'      => 20,
            'message'   => 'Success',
            'payload'   => new DatabaseProxyDataResource($proxy)
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Proxy $proxy
     * @return Response
     * @throws AuthorizationException
     */
    public function destroy(Proxy $proxy)
    {
        $this->authorize('delete', $proxy);

        $proxy->delete();

        return response([
            'code'      => 20,
            'message'   => 'Success',
        ], 200);
    }
}
