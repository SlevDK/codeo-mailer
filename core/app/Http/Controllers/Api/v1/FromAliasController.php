<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Resources\Api\v1\FromAlias as FromAliasResource;
use App\Models\Mail;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class FromAliasController extends Controller
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

        $fromAlias = $mail->fromAlias;

        return response([
            'code'      => 20,
            'message'   => 'Success',
            'payload'   => new FromAliasResource($fromAlias)
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $mail_id
     * @return Response
     * @throws AuthorizationException
     */
    public function update(Request $request, $mail_id)
    {
        $mail = Mail::findOrFail($mail_id);
        $this->authorize('update', $mail);

        $fromAlias = $mail->fromAlias;
        $fromAlias->fill($request->only('data'));
        $fromAlias->save();

        return response([
            'code'      => 20,
            'message'   => 'Success',
            'payload'   => new FromAliasResource($fromAlias)
        ], 200);
    }
}
