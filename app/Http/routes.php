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

/**
 * Genres – List
 * GET /v1/genres
 */
$app->get('v1/genres', [
    'as'         => 'genres',
    'uses'       => 'App\Http\Controllers\GenreController@all'
]);

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

    /**
     * User – Set his preferred genres
     * POST /v1/users/genres
     */
    $app->post('genres', [
        'as'         => 'users_set_genres',
        'uses'       => 'App\Http\Controllers\UserController@setGenres',
        'middleware' => 'auth'
    ]);

});

$app->group(
    [
        'prefix'     => 'v1/movies',
        'namespace'  => 'App\Http\Controllers',
        'middleware' => 'auth'
    ],
    function($app)
{
    /**
     * Movies – Get recommended movies
     * GET /v1/movies/discover
     *
     * @param int $limit
     */
    $app->get('discover', [
        'as'         => 'movies_discover',
        'uses'       => 'MovieController@discover'
    ]);

    /**
     * Movies – Get movies in my wishlist
     * GET /v1/movies/wishlist
     *
     * @param int $limit
     */
    $app->get('wishlist', [
        'as'         => 'movies_wishlist',
        'uses'       => 'MovieController@wishlist'
    ]);

    /**
     * Movies – Rate a movie
     * POST /v1/movies/{movie_id}/rate
     *
     * @param string $rate   Options: 'like', 'dislike'
     */
    $app->post('{movie_id}/rate', [
        'as'         => 'movies_rate',
        'uses'       => 'MovieController@rate'
    ]);

    /**
     * Movies – Delete a rate
     * DELETE /v1/movies/{movie_id}/rate
     */
    $app->delete('{movie_id}/rate', [
        'as'         => 'movies_rate_delete',
        'uses'       => 'MovieController@rateDelete'
    ]);

    /**
     * Movies – Add a movie to your wishlist
     * POST /v1/movies/{movie_id}/wish
     */
    $app->post('{movie_id}/wish', [
        'as'         => 'movies_wish',
        'uses'       => 'MovieController@wish'
    ]);

    /**
     * Movies – Remove a movie from your wishlist
     * DELETE /v1/movies/{movie_id}/wish
     */
    $app->delete('{movie_id}/wish', [
        'as'         => 'movies_wish_delete',
        'uses'       => 'MovieController@wishDelete'
    ]);

    /**
     * Movies – Skip a movie
     * POST /v1/movies/{movie_id}/skip
     */
    $app->post('{movie_id}/skip', [
        'as'         => 'movies_skip',
        'uses'       => 'MovieController@skip'
    ]);
});


