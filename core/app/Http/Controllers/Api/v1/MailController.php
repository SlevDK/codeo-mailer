<?php

namespace App\Http\Controllers\Api\v1;

use App\Events\MailCreated;
use App\Http\Requests\Api\v1\Mails\MailStoreRequest;
use App\Http\Requests\Api\v1\Mails\MailUpdateRequest;
use App\Models\Campaign;
use App\Models\Mail;
use App\Http\Resources\Api\v1\Mail as MailResource;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class MailController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param MailStoreRequest $request
     * @param int $campaign_id
     * @return Response
     * @throws AuthorizationException
     */
    public function store(MailStoreRequest $request, $campaign_id)
    {
        $campaign = Campaign::findOrFail(intval($campaign_id));

        $this->authorize('create', [Mail::class, $campaign]);

        $mail = Mail::initMail($campaign, $request->only('name'));
        event(new MailCreated($mail));

        return response([
            'code'      => 200,
            'message'   => 'Success',
            'payload'   => new MailResource($mail)
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param Mail $mail
     * @return Response
     * @throws AuthorizationException
     */
    public function show(Mail $mail)
    {
        $this->authorize('view', $mail);

        return response([
            'code'      => 200,
            'message'   => 'Success',
            'payload'   => new MailResource($mail)
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param MailUpdateRequest $request
     * @param Mail $mail
     * @return Response
     * @throws AuthorizationException
     */
    public function update(MailUpdateRequest $request, Mail $mail)
    {
        $this->authorize('update', $mail);

        $mail->fill($request->only($mail->fillableProps()));
        $mail->save();

        return response([
            'code'      => 200,
            'message'   => 'Success',
            'payload'   => new MailResource($mail)
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Mail $mail
     * @return void
     * @throws AuthorizationException
     */
    public function destroy(Mail $mail)
    {
        $this->authorize('delete', $mail);

        $mail->delete();

        return response([
            'code' => 20,
            'message' => 'Success'
        ], 200);
    }
}
