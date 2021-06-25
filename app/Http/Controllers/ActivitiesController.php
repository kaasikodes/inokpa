<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Activity;
use App\User;
use App\Notifications\ActivityCreated;
class ActivitiesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth',[
            'except'=>['index','search','searchResults']
            ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activities = Activity::with('course')->orderBy('created_at','desc')->paginate(10);
        return view('activities.general_index', compact('activities'));
    }

    //s tudent activities
    public function student_index()
    {
        //return 'wo';
        $courses = auth()->user()->courses;
        $studentActivities = [];
        foreach ($courses as $course) {
            if ($course->pivot->role == 'student') {
                
                foreach ($course->activities as $activity) {
                    $studentActivities[] = $activity;
                }
            }
        }
        $activities = $studentActivities;
        
        return view('activities.student_index',compact('activities'));
    }

    //teacher activities
    public function teacher_index()
    {
        //return 'wo';
        $courses = auth()->user()->courses;
        $teacherActivities = [];
        foreach ($courses as $course) {
            if ($course->pivot->role == 'teacher') {
                
                foreach ($course->activities as $activity) {
                    $teacherActivities[] = $activity;
                }
            }
        }
        $activities = $teacherActivities;
        
        return view('activities.teacher_index',compact('activities'));
    }

    // just the activities belonging to course
    public function course_index(Course $course)
    {
        //return 'works'
        $activities = Activity::with('course')->where('course_id',$course->id)->orderBy('created_at','desc')->paginate(10);
        return view('activities.course_index', compact('activities','course'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Course $course)
    {
        return view('activities.create', compact('course'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Course $course)
    {
        $data = $this->validateRequest($request);
        $activity = $course->activities()->create($data);
        //notify students of activity created
        $users = $course->users;
        foreach ($users as $user) {
            if ($user->pivot->role == 'student') {
                $user->notify(new ActivityCreated($activity));
          
            }
         
        }
        return redirect("activities/$activity->id")->with('success',"$activity->title has been created !");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Activity $activity)
    {
        return view('activities.show',compact('activity'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Activity $activity)
    {
        return view('activities.edit',compact('activity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Activity $activity)
    {
        $data = $this->validateRequest($request);
        $activity->update($data);
        return redirect("activities/$activity->id")->with('success',"$activity->title has been updated !");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity)
    {
        $course_id = $activity->course->id;
        if ($activity->delete()) {
            return redirect("activities/$course_id/course")->with('success',"$activity->title has been deleted !");
        }
    }


    // search

    public function search(Request $request)
    {
        $title = $this->validateSearchRequest($request);
        
       
        return redirect("search_activities/$title");
    }

    public function searchResults($title)
    {
        
        
        $activities = Activity::searchedActivities($title)->orderBy('created_at','desc')->paginate(10);
        //dd($courses);
        return view('activities.search')->with('activities',$activities);
    }


    // submissions for activity submissions_index
    public function submissions_index(Activity $activity)
    {
        $students = [];
        $sections = $activity->sections;
        foreach ($activity->course->users as $user) {
            if ($user->pivot->role == 'student') {
                $student = $user;
                $gradingStatus = '';
                
                foreach ($sections as $section) {
                    // sectionGradingStatus
                    if ($this->sectionGradingStatus($student,$section) == 'In Progress') {
                        $gradingStatus = 'In Progess'; // if one is in progress then all is in progress
                        break;
                    }else {
                        $gradingStatus = 'No attempt';// if the current iteration is not in progress then no attempt and 
                        //will lead to no attempt- if none was in progress or break and return in progress if at least 1
                        // was in progress
                        continue;
                    }
                    //sectionGradingStatus

                    //
                    
                    
                    
                }

                // now check wether the student submission is in progress,done,or no attempt has been made in terms of grading
                $student->gradingStatus = $gradingStatus;
                $students[] = $student; 
            }
        }
        return view('submissions.index',compact('activity','students'));
    }
    public function submissions_student(Activity $activity, $student)
    {
        $student = User::find($student);
        $sections = $activity->sections;
        foreach ($sections as $section) {
            $section->gradingStatus = $this->sectionGradingStatus($student,$section);
            $section->anyQuestionAnswered = $this->anyQuestionAnswered($student,$section);
            $studentAnswers = $student->answers->where('section_id',$section->id);
            $no_questions_answered = $studentAnswers->count();
            $section->no_of_questions_answered = $no_questions_answered;
            
            
        }
        
        // snd in sections also
        return view('submissions.show',compact('activity','student','sections'));
    }
    


    //Validation of Requests
    private function validateRequest($request){
        return $request->validate([
            'title'=>'required',
            'instruction'=>'required',
            'contribution_to_course_assessment'=>'required'
            

        ]);

    }

    private function validateSearchRequest($request){
        $data = $request->validate([
            'title'=>'required',
            

        ]);
        return $data['title'];

    }

    //section grading status
    private function sectionGradingStatus($student,$section){
        //questions answered by students
        $studentAnswers = $student->answers->where('section_id',$section->id);
        $no_questions_answered = $studentAnswers->count();
        $no_answers_marked = 0;
        foreach ($studentAnswers as $answer) {
            if ($answer->score !== null) {
                $no_answers_marked++;
            }
        }
        if ($no_answers_marked > 0) {
            if ($no_answers_marked < $no_questions_answered) {
                return 'In Progress';
            }
            if($no_answers_marked == $no_questions_answered){
                return 'Finished';

            }
        }else{
            return 'No Attempt';
        }

    }


    //section any question answered status
    private function anyQuestionAnswered($student,$section){
        //questions answered by students
        $studentAnswers = $student->answers->where('section_id',$section->id);
        if ($studentAnswers->count() == 0) {
            return false;
        }else {
            return true;
        }
    }
}
