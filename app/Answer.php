<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $guarded =[];

    public function question()
    {
        return $this->belongsTo('App\Question');
    }

    public function section()
    {
        return $this->belongsTo('App\Section');
    }

    public function scopeUserAnswer($query,$user_id,$question_id)
    {
        $query->where('user_id',$user_id)->where('question_id',$question_id);
    }
}
