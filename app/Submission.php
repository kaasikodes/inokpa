<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $guarded = [];
    public function section()
    {
        return $this->belongsTo('App\Section');
    }

    public function assessment()
    {
        return $this->hasOne('App\Assessment');
    }

    public function activity()
    {
        return $this->belongsTo('App\Activity');
    }
}
