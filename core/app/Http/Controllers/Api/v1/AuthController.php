<?php

namespace App\Http\Controllers\Api\v1;

use App\Exceptions\Api\AuthenticationException;
use App\Http\Requests\Api\v1\Auth\LoginRequest;
use App\Http\Requests\Api\v1\Auth\RegisterRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * AuthController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['register', 'login']]);
    }

    /**
     * Registration via API
     *
     * @param RegisterRequest $request
     * @return Response
     */
    public function register(RegisterRequest $request)
    {
        $credentials = $request->only(['username', 'email', 'password']);
        $credentials['password'] = Hash::make($credentials['password']);
        $credentials['api_token'] = Str::random(60);

        $user = User::create($credentials);

        return $this->sendRegisterResponse($user);
    }

    /**
     * Authentication via API
     *
     * @param LoginRequest $request
     * @return Response
     * @throws AuthenticationException
     */
    public function login(LoginRequest $request)
    {
        try {
            $user = User::where('email', $request->input('email'))
                ->firstOrFail();

            if(!Hash::check($request->input('password'), $user->password))
                throw new AuthenticationException('');
        } catch (ModelNotFoundException $e) {
            // catch non exists email here, better for AuthException
            throw new AuthenticationException('');
        }

        return $this->sendLoginResponse($user);
    }

    /**
     * Send success register response
     *
     * @param User $user
     * @return Response
     */
    protected function sendRegisterResponse(User $user)
    {
        return response([
            'code' => 20,
            'message' => 'Success',
            'payload' => [
                'id' => $user->id,
                'username' => $user->username
            ],

        ], 200);
    }

    /**
     * Send success login response
     *
     * @param $user
     * @return Response
     */
    protected function sendLoginResponse($user)
    {
        return response(['token' => $user->api_token], 200);
    }
}
