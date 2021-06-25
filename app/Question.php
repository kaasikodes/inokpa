<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded =[];

    public function section()
    {
        return $this->belongsTo('App\Section');
    }

    public function answers()
    {
        return $this->hasMany('App\Answer');
    }

}
