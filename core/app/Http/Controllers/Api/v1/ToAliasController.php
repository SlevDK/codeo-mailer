<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Mail;
use App\Http\Resources\Api\v1\ToAlias as ToAliasResource;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class ToAliasController extends Controller
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

        $toAlias = $mail->toAlias;

        return response([
            'code'      => 20,
            'message'   => 'Success',
            'payload'   => new ToAliasResource($toAlias)
        ]);
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

        $toAlias = $mail->toAlias;
        $toAlias->fill($request->only('data'));
        $toAlias->save();

        return response([
            'code'      => 20,
            'message'   => 'Success',
            'payload'   => new ToAliasResource($toAlias)
        ]);
    }
}
