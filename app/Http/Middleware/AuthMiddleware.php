<?php namespace App\Http\Middleware;

use Closure, Auth;

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
        // $data = json_decode($request->getContent(), true);

        // if ( !isset($data['auth_token']) ) {
        //     // error
        // }

        // // Connect the user
        // if ( !Auth::once(['auth_token' => $data['auth_token']]) ) {

        //     // user not found
        // }

        return $next($request);
    }

}
