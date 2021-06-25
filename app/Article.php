<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $guarded = [];

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }
}
