<?php


namespace App\Guards;


use Illuminate\Auth\TokenGuard;
use Illuminate\Support\Str;

class TokenJWTGuard extends TokenGuard
{
    /**
     * Get the token for the current request.
     *
     * @return string|null
     */
    public function getTokenForRequest()
    {
        $token = parent::getTokenForRequest();

        if(empty($token))
            $token = $this->jwtToken();

        return $token;
    }

    /**
     * Retrieve JWT token from request
     *
     * @return string|null
     */
    protected function jwtToken()
    {
        $header = $this->request->header('Authorization', '');

        if (Str::startsWith($header, 'JWT ')) {
            return Str::substr($header, 4);
        }
    }
}