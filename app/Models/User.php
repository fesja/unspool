<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model,
    Illuminate\Contracts\Auth\Authenticatable,
    Illuminate\Auth\Authenticatable as AuthenticatableTrait;

class User extends Model implements Authenticatable {

    use AuthenticatableTrait;

    protected $table = 'users';

    protected $visible = ['id', 'auth_token', 'genres', 'created_at'];

    public function moviesInWishlist()
    {
        return $this->belongsToMany('App\Models\Movie', 'wishes')
            ->withPivot('seen_at')
            ->withTimestamps();
    }
}