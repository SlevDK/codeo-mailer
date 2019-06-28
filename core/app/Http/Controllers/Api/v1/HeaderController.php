<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\Api\v1\Header\HeaderUpdateRequest;
use App\Models\Mail;
use Illuminate\Auth\Access\AuthorizationException;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\Header as HeaderResource;
use Illuminate\Http\Response;

class HeaderController extends Controller
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

        $header = $mail->header;

        return response([
            'status'    => 20,
            'message'   => 'Success',
            'payload'   => new HeaderResource($header)
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param HeaderUpdateRequest $request
     * @param $mail_id
     * @return Response
     * @throws AuthorizationException
     */
    public function update(HeaderUpdateRequest $request, $mail_id)
    {
        $mail = Mail::findOrFail($mail_id);
        $this->authorize('update', $mail);

        $header = $mail->header;
        $header->fill($request->only('data'));
        $header->save();

        return response([
            'status'    => 20,
            'message'   => 'Success',
            'payload'   => new HeaderResource($header)
        ], 200);
    }
}
