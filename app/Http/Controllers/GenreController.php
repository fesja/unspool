<?php namespace App\Http\Controllers;

use App\Models\Genre,
    Cache,
    Illuminate\Support\Facades\Config;

class GenreController extends BaseController
{
    /**
     * Returns a list of all genres
     */
    public function all()
    {
        $minutes = Config::get('constants.cache_genres_expiration');

        $genres = Cache::remember('users', $minutes, function()
        {
            return Genre::all();
        });

        return $this->listResponse($genres);
    }
}
