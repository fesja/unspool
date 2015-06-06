<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model {

    protected $table = 'users';

    protected $visible = ['id', 'auth_token', 'created_at'];

    public function moviesInWishlist()
    {
        return $this->belongsToMany('App\Models\Movie', 'wishes')
            ->withPivot('seen_at')
            ->withTimestamps();
    }
}