<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function answers()
    {
        return $this->hasMany('App\Answer');
    }
    public function courses()
    {
        return $this->belongsToMany('App\Course')->withPivot(['role'])->withTimeStamps();
    }

    public function sectionTimes()
    {
        return $this->hasMany('App\SectionTime');
    }

    public function submissions()
    {
        return $this->hasMany('App\Submission');
    }


}
