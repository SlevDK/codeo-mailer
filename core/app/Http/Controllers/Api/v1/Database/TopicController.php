<?php

namespace App\Http\Controllers\Api\v1\Database;

use App\Http\Requests\Api\v1\Database\TopicStoreRequest;
use App\Http\Requests\Api\v1\Database\TopicUpdateRequest;
use App\Models\Database\Topic;
use App\Http\Resources\Api\v1\Database\TopicData as DatabaseTopicDataResource;
use App\Http\Resources\Api\v1\Database\TopicCollection as DatabaseTopicCollectionResource;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $topics = Topic::ownBy(auth('api')->id())
            ->paginate((intval(request()->limit) > 0)? intval(request()->limit) : 20);

        return response([
            'status' => 20,
            'message' => 'Success',
            'payload' => new DatabaseTopicCollectionResource($topics)
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TopicStoreRequest $request
     * @return Response
     * @throws AuthorizationException
     */
    public function store(TopicStoreRequest $request)
    {
        $this->authorize('create', Topic::class);

        $topic = Topic::initTopic($request->only('name'));

        return response([
            'code'      => 20,
            'message'   => 'Success',
            'payload'   => new DatabaseTopicDataResource($topic)
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param Topic $topic
     * @return Response
     * @throws AuthorizationException
     */
    public function show(Topic $topic)
    {
        $this->authorize('view', $topic);

        return response([
            'code'      => 20,
            'message'   => 'Success',
            'payload'   => new DatabaseTopicDataResource($topic)
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TopicUpdateRequest $request
     * @param Topic $topic
     * @return Response
     * @throws AuthorizationException
     */
    public function update(TopicUpdateRequest $request, Topic $topic)
    {
        $this->authorize('update', $topic);

        $topic->fill($request->only(['name', 'data']));
        $topic->save();

        return response([
            'code'      => 20,
            'message'   => 'Success',
            'payload'   => new DatabaseTopicDataResource($topic)
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Topic $topic
     * @return Response
     * @throws AuthorizationException
     */
    public function destroy(Topic $topic)
    {
        $this->authorize('delete', $topic);

        $topic->delete();

        return response([
            'code'      => 20,
            'message'   => 'Success',
        ], 200);
    }
}
