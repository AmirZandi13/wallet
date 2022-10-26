<?php

namespace App\ThirdParties;

class Authorization
{
    /**
     * @param string $token
     *
     * @return bool
     */
    public static function checkAuthAccessToken(string $token): bool
    {
        // Here we have to make a request to the Auth microservice and check whether the token is valid or not.

        return true;
    }
}
