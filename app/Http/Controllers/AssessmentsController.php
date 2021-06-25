<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Section;
use App\Course;
use App\SectionTime;
use App\User;
use App\Http\Requests;
use App\Answer;
use App\Activity;
use App\Assessment;
use App\Http\Resources\Answer as AnswerResource;
class AssessmentsController extends Controller
{
    public function log_section(Section $section, User $user)
    {
        $activity_id = $section->activity_id;
        return redirect("/submissions/$activity_id/$user->id/student")->with('success', "All done grading the $section->title of $user->name !");
    }
    public function create(Section $section, $student)
    {
        
        
        $student =  User::with('answers')->find($student);
        $answers = $student->answers->where('section_id',$section->id);

        
        $time_left = SectionTime::where('section_id', $section->id)->where('user_id',$student->id)
                                                                   ->first()
                                                                   ->time_left;
        $actual_time = $this->timeDurationFormatter($section->time_duration);
        $time_spent =  $this->timeDurationFormatter($section->time_duration - $time_left);
        if($section->category == 'MCQ'){
            

            foreach ($answers as $answer) {
                
                $answer->update([

                    'score' => $answer->content == $answer->question->correct_answer ? 1 : 0,
                ]);
                
            }
        }
        
        return view('assessments.create',compact('section','actual_time','time_spent','student', 'answers'));
    }
    public function course_index(Course $course)
    {
        $activities  = $course->activities;
        $students = [];
        foreach ($course->users as $user) {
            if ($user->pivot->role == 'student') {
                $student = $user;
                $studentActivityPercentages = [];
                
                
                // for course as a whole
                $studentCATotal = 0;
                $studentCAExpected = 0;
                $courseCAPercentage = $course->activities->sum('contribution_to_course_assessment');
                
                foreach ($activities as $activity) {
                    $percentage = $activity->contribution_to_course_assessment;
                    $total = $student->answers->where('activity_id',$activity->id)->sum('score');
                    $expected = 0;
                    
                    foreach ($activity->sections as $section) {
                        if ($section->questions->count() > 0) {
                            $expected += $section->questions->sum('mark');
                        }
                        
                    }
                    $studentActivityPercentages[] = round($this->percentageConverter($total,$expected,$percentage),2);
                    // this is for total of course as a whole
                    $studentCATotal += $total;
                    $studentCAExpected += $expected;
                }
                $student->activities = $studentActivityPercentages;
                $student->total = round($this->percentageConverter($studentCATotal,$studentCAExpected,$courseCAPercentage),2);
                $student->grade = $this->studentGrade($studentCATotal,$studentCAExpected);
                $students[] = $student;
            }
        }
        return view('assessments.course_index',compact('course','activities','students'));
    }
    public function student_course_index(Course $course, User $user)
    {
        $activities  = $course->activities;
        $user = $course->users()->where('user_id',$user->id)->first();
        
        
        
            if ($user->pivot->role == 'student') {
                $student = $user;
               
                
                
                // for course as a whole
                $studentCATotal = 0;
                $studentCAExpected = 0;
                $courseCAPercentage = $course->activities->sum('contribution_to_course_assessment');
                
                foreach ($activities as $activity) {
                    $percentage = $activity->contribution_to_course_assessment;
                    $total = $student->answers->where('activity_id',$activity->id)->sum('score');
                    $expected = 0;
                    
                    foreach ($activity->sections as $section) {
                        if ($section->questions->count() > 0) {
                            $expected += $section->questions->sum('mark');
                        }
                        
                    }
                    $activity->studentScore = round($this->percentageConverter($total,$expected,$percentage),2);
                    // this is for total of course as a whole
                    $studentCATotal += $total;
                    $studentCAExpected += $expected;
                }
                
                $student->total = round($this->percentageConverter($studentCATotal,$studentCAExpected,$courseCAPercentage),2);
                $student->grade = $this->studentGrade($studentCATotal,$studentCAExpected);
                
            }
        
        return view('assessments.student_course_index',compact('course','activities','student'));
    }
    


    public function activity_index(Activity $activity)
    {
        
        $users = $activity->course->users;
        $sections = $activity->sections;
        $activityTotalExpected = 0;
        foreach ($sections as $section) {
                    
            $activityTotalExpected += $section->questions->sum('mark');
            
        }
        $activity->activityTotalExpected = $activityTotalExpected;
        
        $students = [];
        foreach ($users as $user) {
            if ($user->pivot->role == 'student') {
               
                // set each section for each user
                
                $activityTotalScored = 0;
                foreach ($sections as $section) {
                    
                    $activityTotalScored += $section->answers->where('user_id',$user->id)->sum('score');
                    
                }
                $user->activityTotalScored = $activityTotalScored;
                $contributionToCA = $this->contributionToCA($activityTotalScored,$activityTotalExpected,$activity->contribution_to_course_assessment);
                $user->contributionToCA = round($contributionToCA,2);
                $user->activityGrade = $this->studentGrade($contributionToCA,$activity->contribution_to_course_assessment);
                $students[] = $user;
            }
        }
        


        return view('assessments.activity_index',compact('activity','students','sections'));
    }


    public function save_score(Answer $answer, Request $request)
    {
        $data = $this->validateRequest($request);

        // appplicable to only theory
        $answer->update($data);
        return new AnswerResource($answer);
        
        
    }


    public function show_score(Answer $answer)
    {
        
        //return 'workin';
        return new AnswerResource($answer);
        
        
    }







    // time_duration_formatter
    private function timeDurationFormatter($time)
    {
        
        $hr = round(floor($time/(1000*60*60)),2);
        $min = round(floor($time%(1000*60*60))/(1000*60),0);
        return "$hr:$min";
    }




    private function validateRequest($request)
    {
        //return 'works';
        $data = $request->validate([
            
            
            'score'=>'required'
            

        ]);
        
        return $data;
    }

    private function contributionToCA($total,$totalExpected,$percentageContribution)
    {
       $percentageForm = $totalExpected == 0 ? 0 : ($total/$totalExpected) * $percentageContribution;
       return $percentageForm;
    }
    private function studentGrade($studentPercentage,$percentageContribution)
    {
        $percentage = $percentageContribution == 0 ? 0 : ($studentPercentage/$percentageContribution) * 100;
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

    private function percentageConverter($total, $expected, $percentage){
        $result  =  $expected == 0 ? 0 : ($total/$expected) * $percentage ;
        return $result;
    }
}
