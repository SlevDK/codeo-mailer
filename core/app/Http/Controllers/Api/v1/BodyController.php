<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\Api\v1\Body\BodyUpdateRequest;
use App\Models\Mail;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\Body as BodyResource;
use Illuminate\Http\Response;

class BodyController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param $mail_id
     * @return Response
     * @throws AuthorizationException
     */
    public function show($mail_id)
    {
        $mail = Mail::findOrFail($mail_id);
        $this->authorize('view', $mail);

        $body = $mail->body;

        return response([
            'status'    => 20,
            'message'   => 'Success',
            'payload'   => new BodyResource($body)
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BodyUpdateRequest $request
     * @param $mail_id
     * @return Response
     * @throws AuthorizationException
     */
    public function update(BodyUpdateRequest $request, $mail_id)
    {
        $mail = Mail::findOrFail($mail_id);
        $this->authorize('update', $mail);

        $body = $mail->body;
        $body->fill($request->only('content'));
        $body->save();

        return response([
            'status'    => 20,
            'message'   => 'Success',
            'payload'   => new BodyResource($body)
        ], 200);
    }
}
