<?php

namespace App\Helpers;

use Auth;

class AuthenticationHelper 
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public static function generateToken()
    {
        $user = Auth::user();

        $instance = $user->token;

        dd($instance);

        return $instance->accessToken;
    }
}
