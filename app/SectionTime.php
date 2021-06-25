<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SectionTime extends Model
{
    protected $guarded =[];
    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
