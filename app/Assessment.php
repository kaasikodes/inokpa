<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    protected $guarded = [];
    public function section()
    {
        return $this->belongsTo('App\Section');
    }

    public function submission()
    {
        return $this->belongsTo('App\Submission');
    }


}
