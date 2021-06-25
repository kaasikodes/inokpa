<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\User;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function student()
    {
        $student = User::find(auth()->user()->id);
        //return $student ->id;
        $userCourses = $student->courses;
        //return $userCourses;
        $courses = [];
        foreach ($userCourses as $course) {
            
            if ($course->pivot->role =='student') {

                $course->assessmentCompletionRate = $this->assessmentCompletionRate($course);
                $studentCourseTotalCA = $this->studentCourseTotalCA($course,$student);
                $expectedCourseTotal = $this->expectedCourseTotal($course);
                $studentCASofar = $this->percentageStudentCourseTotalCA($studentCourseTotalCA,$expectedCourseTotal,$course->assessmentCompletionRate);
                $course->studentCASofar = round($studentCASofar,2);
                $course->studentCourseGrade = $this->studentCourseGrade($studentCASofar,$course->assessmentCompletionRate);
                

                $courses[] = $course;
                
            }
            # code...
        };

        //dd($courses);
      

        return view('dashboard.student')->with([
            'courses'=> $courses,
            'student'=> $student,
            'success'=> "Welcome, $student->name ! Have a good time learning."
            ]);
    }


    public function teacher()
    {
        $teacher = User::find(auth()->user()->id);
        //return $student ->id;
        $userCourses = $teacher->courses;
        //return $userCourses;
        $courses = [];
        foreach ($userCourses as $course) {
            
            if ($course->pivot->role =='teacher') {


                $course->assessmentCompletionRate = $this->assessmentCompletionRate($course);
                //make an object for no_of_students_available
                $no_of_students_available = 0;
                foreach ($course->users as $user) {
                    if ($user->pivot->role == 'student') {
                        $no_of_students_available++;
                    }
                    
                }
                $course->no_of_students_available = $no_of_students_available;

                // add to courses array
                $courses[] = $course;
                
            }
            # code...
        };

        //dd($courses);
        //make an object for no_of_students_available

        return view('dashboard.teacher')->with([
            'courses'=> $courses,
            'teacher'=> $teacher,
            'success'=> "Welcome, $teacher->name ! Have a good time learning."
            ]);
    }


    private function assessmentCompletionRate($course)
    {
        return $course->activities->sum('contribution_to_course_assessment');
    }

    private function studentCourseTotalCA($course,$student)
    {
        $studentCourseTotalCA = 0;
        foreach ($course->activities as $activity) {
            
            foreach ($activity->sections as $section) {
                
                $studentCourseTotalCA += $section->answers->where('user_id',$student->id)->sum('score');
                
            }
        }
        return $studentCourseTotalCA;
    }



    private function expectedCourseTotal($course)
    {
        $expectedCourseTotal = 0;
        foreach ($course->activities as $activity) {
            
            foreach ($activity->sections as $section) {
                
                $expectedCourseTotal += $section->questions->sum('mark');
                
            }
        }
        return $expectedCourseTotal;
    }


    private function percentageStudentCourseTotalCA($actual,$expected,$percentage)
    {
        return $expected == 0 ? 0 : ($actual/$expected) * $percentage;
    }



    private function studentCourseGrade($studentPercentage,$percentageContribution)
    {
        $percentage = ($percentageContribution == 0 ? 0 : (($studentPercentage/$percentageContribution) * 100));
        if ($percentage >= 0 && $percentage <= 40) {
            return 'f';
        }

        if ($percentage > 40  && $percentage <= 50) {
            return 'p';
        }

        if ($percentage > 50 && $percentage <= 60) {
            return 'c';
        }

        if ($percentage > 60  && $percentage <= 70) {
            return 'b';
        }
        if ($percentage > 70 && $percentage <= 100) {
            return 'a';
        }
    }
}
