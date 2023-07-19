<?php

namespace App\Auth;


use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;

    class CustomUserProvider implements UserProvider
{
    public $email = '';
    public $fullName = '';
    public $merchantId = '';
    public $accountStatus = '';
    public $isPayoutEnable = false;
    public $isDashboardPayoutEnable = false;

    public function retrieveById($identifier)
    {
        return $this;
    }


    public function retrieveByToken($identifier, $token)
    {
        // TODO: Implement retrieveByToken() method.
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
        // TODO: Implement updateRememberToken() method.
    }

    public function retrieveByCredentials(array $credentials)
    {
        // TODO: Implement retrieveByCredentials() method.
    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        // TODO: Implement validateCredentials() method.
    }

    public function getAuthIdentifier() {
        return $this->email;
    }
}
