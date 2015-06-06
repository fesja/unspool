<?php namespace App\Http\Controllers;

use App\Models\Genre,
    App\Models\User,
    Auth,
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
        $auth_token = Request::header('X-AUTH-TOKEN');

        if ( !$auth_token ) {
            return $this->requestErrorResponse(['X-AUTH-TOKEN' => 'You need to provide an auth token']);
        }

        $user = User::whereAuthToken($auth_token)->first();

        if ( !$user ) {
            $user = new User;
            $user->auth_token = $auth_token;
            $user->save();
        }

        return $this->createdResponse($user);
    }

    /**
     * Set the preferred genres of the user
     */
    public function setGenres()
    {
        $data = $this->getBody();
        $genres = isset($data['genres']) ? $data['genres'] : '';

        if ( !$genres || !is_array($genres) ) {
            return $this->requestErrorResponse(['genres' => 'You need to provide an array with the genre IDs']);
        }

        foreach ($genres as $genreId) {
            if ( !Genre::find($genreId) ){
                return $this->requestErrorResponse(['genres' => sprintf('The genre %s does not exist', $genreId)]);
            }
       }

       $user = Auth::user();
       $user->genres = implode(',', $genres);
       $user->save();

       return $this->createdResponse($user);
    }
}
