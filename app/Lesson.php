<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Lesson extends Model
{
    protected $guarded = [];

    public function scopeSearchedLessons($query,$title)
    {
        $query->where('title','LIKE','%'.$title.'%');
    }


    public function course()
    {
        return $this->belongsTo('App\Course');
    }

    public function files()
    {
        return $this->hasMany('App\File');
    }

    public function links()
    {
        return $this->hasMany('App\Link');
    }

    public function getPathAttribute(){
        return url('lessons/'.$this->id.'/'.Str::slug($this->title));
    }

}
