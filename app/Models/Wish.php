<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wish extends Model {

    protected $table = 'wishes';

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function movie()
    {
        return $this->belongsTo('App\Models\Movie');
    }

}