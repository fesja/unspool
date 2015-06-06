<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class UserController extends BaseController
{
    /**
     * Create a new user based on a unique ID given by the mobile client
     *
     * @param  int $udid
     */
    public function create(Request $request)
    {
        $data = $this->getBody($request);

        $user = User::whereAuthToken($data['auth_token'])->first();

        if ( !$user ) {
            $user = new User;
            $user->auth_token = $data['auth_token'];
            $user->save();
        }

        return $this->createdResponse($user);
    }
}
