<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\User as UserResource;
use Illuminate\Http\Response;

class AccountController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @return Response
     */
    public function show()
    {
        return response([
            'status'    => 20,
            'message'   => 'Success',
            'payload'   => new UserResource(auth('api')->user())
        ], 200);
    }
}
