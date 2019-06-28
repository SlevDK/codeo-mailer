<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\Api\v1\Topics\TopicUpdateRequest;
use App\Models\Mail;
use App\Http\Resources\Api\v1\Topic as TopicResource;
use Illuminate\Auth\Access\AuthorizationException;
use App\Http\Controllers\Controller;

class TopicController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param integer $mail_id
     * @return void
     * @throws AuthorizationException
     */
    public function show($mail_id)
    {
        $mail = Mail::findOrFail($mail_id);

        $this->authorize('view', $mail);

        $topic = $mail->topic;

        return response([
            'status'    => 20,
            'message'   => 'Success',
            'payload'   => new TopicResource($topic)
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TopicUpdateRequest $request
     * @param integer $mail_id
     * @return void
     * @throws AuthorizationException
     */
    public function update(TopicUpdateRequest $request, $mail_id)
    {
        $mail = Mail::findOrFail($mail_id);
        $this->authorize('update', $mail);

        $topic = $mail->topic;
        $topic->fill($request->only('data'));
        $topic->save();

        return response([
            'status'    => 20,
            'message'   => 'Success',
            'payload'   => new TopicResource($topic)
        ], 200);
    }
}
