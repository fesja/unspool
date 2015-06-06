<?php namespace App\Http\Controllers;

use App\Models\Genre;

class GenreController extends BaseController
{
    /**
     * Returns a list of all genres
     */
    public function all()
    {
        $genres = Genre::all();

        return $this->listResponse($genres);
    }
}
