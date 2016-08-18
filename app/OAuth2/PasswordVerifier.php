<?php
/**
 * Created by PhpStorm.
 * User: Plazari
 * Date: 18/08/2016
 * Time: 16:41
 * https://github.com/lucadegasperi/oauth2-server-laravel/blob/master/docs/authorization-server/password.md
 */

namespace CodeDelivery\OAuth2;


use Illuminate\Support\Facades\Auth;

class PasswordVerifier
{
    public function verify($username, $password)
    {
        $credentials = [
            'email'    => $username,
            'password' => $password,
        ];

        if (Auth::once($credentials)) {
            return Auth::user()->id;
        }

        return false;
    }

}