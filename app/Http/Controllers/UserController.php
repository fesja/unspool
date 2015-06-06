<?php namespace App\Http\Controllers;

use App\Models\User,
    Request;

class UserController extends BaseController
{
    /**
     * Create a new user based on a unique ID given by the mobile client
     *
     * @param  int $udid
     */
    public function create()
    {
        $auth_token = Request::header('X-Auth-Token');

        if ( !$auth_token ) {
            return $this->requestErrorResponse(['Auth token' => 'You need to provide an auth token']);
        }

        $user = User::whereAuthToken($auth_token)->first();

        if ( !$user ) {
            $user = new User;
            $user->auth_token = $auth_token;
            $user->save();
        }

        return $this->createdResponse($user);
    }
}
