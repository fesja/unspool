<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

$app->group(['prefix' => 'v1/users'], function($app)
{
    /**
     * User – Create a new user
     * POST /v1/users
     *
     * @param string $id
     */
    $app->post('', [
        'as'         => 'users_create',
        'uses'       => 'App\Http\Controllers\UserController@create'
    ]);

});

$app->group(['prefix' => 'v1/movies'], function($app)
{
    /**
     * Movies – Get recommended movies
     * GET /v1/movies/discover
     *
     * @param int $limit
     */
    $app->get('discover', [
        'as'         => 'movies_discover',
        'uses'       => 'App\Http\Controllers\MovieController@discover',
        'middleware' => 'auth'
    ]);

    /**
     * Movies – Get movies in my wishlist
     * GET /v1/movies/wishlist
     *
     * @param int $limit
     */
    $app->get('wishlist', [
        'as'         => 'movies_wishlist',
        'uses'       => 'App\Http\Controllers\MovieController@wishlist',
        'middleware' => 'auth'
    ]);

    /**
     * Movies – Rate a movie
     * POST /v1/movies/{movie_id}/rate
     *
     * @param string $rate   Options: 'like', 'dislike'
     */
    $app->post('{movie_id}/rate', [
        'as'         => 'movies_rate',
        'uses'       => 'App\Http\Controllers\MovieController@rate',
        'middleware' => 'auth'
    ]);

    /**
     * Movies – Delete a rate
     * DELETE /v1/movies/{movie_id}/rate
     */
    $app->delete('{movie_id}/rate', [
        'as'         => 'movies_rate_delete',
        'uses'       => 'App\Http\Controllers\MovieController@rateDelete',
        'middleware' => 'auth'
    ]);

    /**
     * Movies – Add a movie to your wishlist
     * POST /v1/movies/{movie_id}/wish
     */
    $app->post('{movie_id}/wish', [
        'as'         => 'movies_wish',
        'uses'       => 'App\Http\Controllers\MovieController@wish',
        'middleware' => 'auth'
    ]);

    /**
     * Movies – Remove a movie from your wishlist
     * DELETE /v1/movies/{movie_id}/wish
     */
    $app->delete('{movie_id}/wish', [
        'as'         => 'movies_wish_delete',
        'uses'       => 'App\Http\Controllers\MovieController@wishDelete',
        'middleware' => 'auth'
    ]);

    /**
     * Movies – Skip a movie
     * POST /v1/movies/{movie_id}/skip
     */
    $app->post('{movie_id}/skip', [
        'as'         => 'movies_skip',
        'uses'       => 'App\Http\Controllers\MovieController@skip',
        'middleware' => 'auth'
    ]);
});


