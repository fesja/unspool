<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model {

    protected $table = 'movies';

    protected $visible = ['id', 'title', 'year', 'rating', 'runtime', 'genre', 'released', 'director', 'cast',
        'imdb_rating', 'poster', 'full_plot', 'awards', 'rt_meter',  'created_at'];

    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'wishes');
    }

}