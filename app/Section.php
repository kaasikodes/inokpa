<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $guarded = [];

    public function activity()
    {
        return $this->belongsTo('App\Activity');
    }

  

    public function questions()
    {
        return $this->hasMany('App\Question');
    }

    public function submissions()
    {
        return $this->hasMany('App\Submission');
    }

    public function assessments()
    {
        return $this->hasMany('App\Assessment');
    }

    public function answers()
    {
        return $this->hasMany('App\Answer');
    }
}
