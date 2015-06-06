<?php namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Movie;
use App\Models\Rating;
use App\Models\Wish;

use Auth,
    Request,
    DB;

class MovieController extends BaseController
{
    /**
     * Return a list of movies for the user to discover
     */
    public function discover()
    {
        $movies = Movie::where('imdb_votes', '>', 1000)
            ->where('imdb_rating', '>', 7)
            //->orderBy('imdb_rating', 'desc')
            ->orderBy('year', 'desc')
            ->take(5)
            ->get();

        return $this->listResponse($movies);
    }

    /**
     * Return movies from the user's wishlist
     */
    public function wishlist()
    {
        $moviesInWishlist = Auth::user()->moviesInWishlist()
            ->wherePivot('seen_at', '=', NULL)
            ->take(100)
            ->get();

        return $this->listResponse($moviesInWishlist);
    }

    /**
     * Rate a movie
     *
     * @param  int $movie_id
     */
    public function rate(Request $request, $movie_id)
    {
        $data = $this->getBody();
        $rate = isset($data['rate']) ? $data['rate'] : '';

        if ( !$rate || !in_array($rate, array('like', 'dislike')) ) {
            return $this->requestErrorResponse(['rate' => 'Its value must be like or dislike']);
        }

        $user = Auth::user();

        $movie = Movie::find($movie_id);

        if ( !$movie ) {
            return $this->notFoundResponse();
        }

        $rating = Rating::where('user_id', $user->id)
            ->where('movie_id', $movie->id)
            ->first();

        if ( !$rating ) {
            $rating = new Rating;
            $rating->user_id  = $user->id;
            $rating->movie_id = $movie->id;
        }

        if ( !$rating->setRating($rate) ){
            // There has been an error
        }

        $rating->save();

        // Update the wish
        $wish = Wish::where('user_id', $user->id)
            ->where('movie_id', $movie->id)
            ->first();

        if ( $wish ) {
            $wish->seen_at = new \DateTime('now');
            $wish->save();
        }

        return $this->createdResponse();
    }

    /**
     * Delete a rate from a movie
     *
     * @param  int $movie_id
     */
    public function rateDelete($movie_id)
    {
        Rating::where('user_id', Auth::user()->id)
            ->where('movie_id', $movie_id)
            ->delete();

        return $this->deletedResponse();
    }

    /**
     * Add a movie to your wishlist
     *
     * @param  int $movie_id
     */
    public function wish($movie_id)
    {
        $movie = Movie::find($movie_id);

        if ( !$movie ) {
            return $this->notFoundResponse();
        }

        $wish = new Wish;
        $wish->user_id  = Auth::user()->id;
        $wish->movie_id = $movie->id;

        try {
            $wish->save();
        }
        catch(\Exception $e) {
            // duplicate
        }

        return $this->createdResponse();
    }

    /**
     * Remove a movie from your wishlist
     *
     * @param  int $movie_id
     */
    public function wishDelete($movie_id)
    {
        Wish::where('user_id', Auth::user()->id)
            ->where('movie_id', $movie_id)
            ->delete();

        return $this->deletedResponse();
    }

    /**
     * Skip a movie
     *
     * @param  int $movie_id
     */
    public function skip($movie_id)
    {
        $data = ['id' => $movie_id];

        return $this->createdResponse($data);
    }
}