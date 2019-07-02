<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\Api\v1\FromLogin\FromLoginUpdateRequest;
use App\Models\Mail;
use App\Http\Resources\Api\v1\FromLogin as FromLoginResource;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class FromLoginController extends Controller
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

        $fromLogins = $mail->fromLogin;

        return response([
            'code'      => 20,
            'message'   => 'Success',
            'payload'   => new FromLoginResource($fromLogins)
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param FromLoginUpdateRequest $request
     * @param $mail_id
     * @return Response
     * @throws AuthorizationException
     */
    public function update(FromLoginUpdateRequest $request, $mail_id)
    {
        $mail = Mail::findOrFail($mail_id);
        $this->authorize('update', $mail);

        $fromLogins = $mail->fromLogin;
        $fromLogins->fill($request->only('data'));
        $fromLogins->save();

        return response([
            'code'      => 20,
            'message'   => 'Success',
            'payload'   => new FromLoginResource($fromLogins)
        ], 200);
    }
}
