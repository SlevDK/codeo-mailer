<?php

namespace App\Http\Controllers\Api\v1\Database;

use App\Http\Requests\Api\v1\Database\MaillistStoreRequest;
use App\Http\Requests\Api\v1\Database\MaillistUpdateRequest;
use App\Http\Resources\Api\v1\Database\MaillistCollection as DatabaseMaillistCollectionResource;
use App\Http\Resources\Api\v1\Database\MaillistData as DatabaseMaillistDataResource;
use App\Models\Database\Maillist;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class MaillistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $maillists = Maillist::ownBy(auth('api')->id())
            ->paginate((intval(request()->limit) > 0)? intval(request()->limit) : 20);

        return response([
            'status' => 20,
            'message' => 'Success',
            'payload' => new DatabaseMaillistCollectionResource($maillists)
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param MaillistStoreRequest $request
     * @return Response
     * @throws AuthorizationException
     */
    public function store(MaillistStoreRequest $request)
    {
        $this->authorize('create', Maillist::class);

        $maillist = Maillist::initMaillist($request->only('name'));

        return response([
            'code'      => 20,
            'message'   => 'Success',
            'payload'   => new DatabaseMaillistDataResource($maillist)
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param Maillist $maillist
     * @return Response
     * @throws AuthorizationException
     */
    public function show(Maillist $maillist)
    {
        $this->authorize('view', $maillist);

        return response([
            'code'      => 20,
            'message'   => 'Success',
            'payload'   => new DatabaseMaillistDataResource($maillist)
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param MaillistUpdateRequest $request
     * @param Maillist $maillist
     * @return Response
     * @throws AuthorizationException
     */
    public function update(MaillistUpdateRequest $request, Maillist $maillist)
    {
        $this->authorize('update', $maillist);

        $maillist->fill($request->only(['name', 'data']));
        $maillist->save();

        return response([
            'code'      => 20,
            'message'   => 'Success',
            'payload'   => new DatabaseMaillistDataResource($maillist)
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Maillist $maillist
     * @return Response
     * @throws AuthorizationException
     */
    public function destroy(Maillist $maillist)
    {
        $this->authorize('delete', $maillist);

        $maillist->delete();

        return response([
            'code'      => 20,
            'message'   => 'Success',
        ], 200);
    }
}
