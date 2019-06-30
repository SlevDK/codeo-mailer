<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Requests\Api\v1\MailSettings\MailSettingsUpdateRequest;
use App\Models\Mail;
use App\Http\Resources\Api\v1\MailSettings as MailSettingsResource;
use Illuminate\Auth\Access\AuthorizationException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class MailSettingsController extends Controller
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

        $settings = $mail->settings;

        return response([
            'code'  => 20,
            'message'   => 'Success',
            'payload'   => new MailSettingsResource($settings)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param MailSettingsUpdateRequest $request
     * @param $mail_id
     * @return void
     * @throws AuthorizationException
     */
    public function update(MailSettingsUpdateRequest $request, $mail_id)
    {
        $mail = Mail::findOrFail($mail_id);
        $this->authorize('update', $mail);

        $settings = $mail->settings;
        $settings->fill($request->only($settings->fillableProps()));
        $settings->save();

        return response([
            'code'  => 20,
            'message'   => 'Success',
            'payload'   => new MailSettingsResource($settings)
        ]);
    }
}
