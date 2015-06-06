<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model {

    protected $table = 'ratings';

    protected $ratings = [
        'like'    => 1,
        'dislike' => -1
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function movie()
    {
        return $this->belongsTo('App\Models\Movie', 'movie_id');
    }

    /**
     * Set the value for the given rating
     * @param String $rating
     * @return boolean True if the parameter was valid
     */
    public function setRating($rating) {

        if ( isset($this->ratings[ $rating ]) ) {
            $this->rating = $this->ratings[ $rating ];
            return true;
        }

        return false;
    }

}