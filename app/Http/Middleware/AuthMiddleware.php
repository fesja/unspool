<?php namespace App\Http\Middleware;

use App\Models\User,
    Auth,
    Closure,
    Request;

class AuthMiddleware {

    /**
     * Authtenticate the user
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $auth_token = Request::header('X-AUTH-TOKEN');

        if ( !$auth_token ) {
            $response = [
                'code'    => 401,
                'status'  => 'error',
                'data'    => [],
                'message' => 'You need to provide an auth token'
            ];
            return response()->json($response, $response['code']);
        }

        $user = User::whereAuthToken($auth_token)->first();

        if ( !$user ) {
            $response = [
                'code'    => 401,
                'status'  => 'error',
                'data'    => [],
                'message' => 'The auth token is incorrect'
            ];
            return response()->json($response, $response['code']);
        }

        Auth::login($user);

        return $next($request);
    }

}
