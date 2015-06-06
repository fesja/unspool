<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model {

    protected $table = 'movies';

    protected $visible = ['id', 'title', 'year', 'rating', 'runtime', 'genre', 'released', 'director', 'cast',
        'imdb_rating', 'poster', 'full_plot', 'awards', 'rt_meter',  'created_at'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'year'        => 'int',
        'imdb_rating' => 'double',
        'rt_meter'    => 'int'
    ];

    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'wishes');
    }

    /**
     * Return the poster URL of a bigger size
     * @return String
     */
    public function getPosterAttribute()
    {
        $posterAr = explode("._V1", $this->attributes['poster']);

        return $posterAr[0]."._V1_SX1280_SY1440_.jpg";
    }

}