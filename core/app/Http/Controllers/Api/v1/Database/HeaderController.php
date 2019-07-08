<?php

namespace App\Http\Controllers\Api\v1\Database;

use App\Http\Requests\Api\v1\Database\HeaderUpdateRequest;
use App\Http\Resources\Api\v1\Database\HeaderCollection as DatabaseHeaderCollectionResource;
use App\Http\Resources\Api\v1\Database\HeaderData as DatabaseHeaderDataResource;
use App\Models\Database\Header;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class HeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $headers = Header::ownBy(auth('api')->id())
            ->paginate((intval(request()->limit) > 0)? intval(request()->limit) : 20);

        return response([
            'status' => 20,
            'message' => 'Success',
            'payload' => new DatabaseHeaderCollectionResource($headers)
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     * @throws AuthorizationException
     */
    public function store(Request $request)
    {
        $this->authorize('create', Header::class);

        $header = Header::initHeader($request->only('name'));

        return response([
            'code'      => 20,
            'message'   => 'Success',
            'payload'   => new DatabaseHeaderDataResource($header)
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param Header $header
     * @return Response
     * @throws AuthorizationException
     */
    public function show(Header $header)
    {
        $this->authorize('view', $header);

        return response([
            'code'      => 20,
            'message'   => 'Success',
            'payload'   => new DatabaseHeaderDataResource($header)
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param HeaderUpdateRequest $request
     * @param Header $header
     * @return Response
     * @throws AuthorizationException
     */
    public function update(HeaderUpdateRequest $request, Header $header)
    {
        $this->authorize('update', $header);

        $header->fill($request->only(['name', 'data']));
        $header->save();

        return response([
            'code'      => 20,
            'message'   => 'Success',
            'payload'   => new DatabaseHeaderDataResource($header)
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Header $header
     * @return Response
     * @throws AuthorizationException
     */
    public function destroy(Header $header)
    {
        $this->authorize('delete', $header);

        $header->delete();

        return response([
            'code'      => 20,
            'message'   => 'Success',
        ], 200);
    }
}
