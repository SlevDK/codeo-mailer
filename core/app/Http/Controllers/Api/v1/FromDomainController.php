<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\Api\v1\FromDomain\FromDomainUpdateRequest;
use App\Http\Resources\Api\v1\FromDomain as FromDomainResource;
use App\Models\Mail;
use Illuminate\Auth\Access\AuthorizationException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class FromDomainController extends Controller
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

        $fromDomains = $mail->fromDomain;

        return response([
            'code'      => 20,
            'message'   => 'Success',
            'payload'   => new FromDomainResource($fromDomains)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param FromDomainUpdateRequest $request
     * @param $mail_id
     * @return Response
     * @throws AuthorizationException
     */
    public function update(FromDomainUpdateRequest $request, $mail_id)
    {
        $mail = Mail::findOrFail($mail_id);
        $this->authorize('update', $mail);

        $fromDomains = $mail->fromDomain;
        $fromDomains->fill($request->only('data'));
        $fromDomains->save();

        return response([
            'code'      => 20,
            'message'   => 'Success',
            'payload'   => new FromDomainResource($fromDomains)
        ]);
    }
}
