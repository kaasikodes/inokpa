<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $guarded = [];

    public function scopeSearchedActivities($query,$title)
    {
        $query->where('title','LIKE','%'.$title.'%');
    }

    public function course()
    {
        return $this->belongsTo('App\Course');
    }

    public function sections()
    {
        return $this->hasMany('App\Section');
    }

    public function submissions()
    {
        return $this->hasMany('App\Submission');
    }
}
