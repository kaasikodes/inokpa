<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $guarded = [];
    protected $appends = ['no_of_students'];

    public function scopeSearchedCourses($query,$title)
    {
        $query->where('title','LIKE','%'.$title.'%');
    }


    public function getNoOfStudentsAttribute()
    {
        
        $no_of_students = 0;
        foreach ($this->users as $user) {
            if ($user->pivot->role == 'student') {
                $no_of_students++;
            }
        }
        return $no_of_students;


    }

    

    // This is the user who creates the course and will also be given the role of Teacher and will be the only person capable of deleting courses
    public function users()
    {
        return $this->belongsToMany('App\User')->withPivot(['role'])->withTimeStamps();
    }

    public function lessons()
    {
        return $this->hasMany('App\Lesson');
    }

    public function activities()
    {
        return $this->hasMany('App\Activity');
    }

    public function submissions()
    {
        return $this->hasMany('App\Submission');
    }

    public function assessments()
    {
        return $this->hasMany('App\Assessment');
    }

    // The course model uses a hasMany relationship- a pivot table btwn courses and users to indicate their roles as either student or teachers of the course
}
