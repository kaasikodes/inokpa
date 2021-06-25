<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Lesson;
use App\Link;
use App\File;
use App\Notifications\LessonCreated;

class LessonsController extends Controller
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
        //return 'works';
        $lessons = Lesson::with('course')->orderBy('created_at','desc')->paginate(10);
        return view('lessons.general_index', compact('lessons'));
    
    }
    //s tudent lessons
    public function student_index()
    {
        //return 'wo';
        $courses = auth()->user()->courses;
        $studentLessons = [];
        foreach ($courses as $course) {
            if ($course->pivot->role == 'student') {
                
                foreach ($course->lessons as $lesson) {
                    $studentLessons[] = $lesson;
                }
            }
        }
        $lessons = $studentLessons;
        
        //dd(Course::with('users')->orderBy('created_at','desc')->get())   ;
        return view('lessons.student_index',compact('lessons'));
    }


    //teacher lessons
    public function teacher_index()
    {
        //return 'wo';
        $courses = auth()->user()->courses;
        $teacherLessons = [];
        foreach ($courses as $course) {
            if ($course->pivot->role == 'teacher') {
                
                foreach ($course->lessons as $lesson) {
                    $teacherLessons[] = $lesson;
                }
            }
        }
        $lessons = $teacherLessons;
        
        //dd(Course::with('users')->orderBy('created_at','desc')->get())   ;
        return view('lessons.teacher_index',compact('lessons'));
    }

    // just the lessons belonging to course
    public function course_index(Course $course)
    {
        //return 'works'
        $lessons = Lesson::with('course')->where('course_id',$course->id)->orderBy('created_at','desc')->paginate(10);
        return view('lessons.course_index', compact('lessons','course'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Course $course)
    {
        return view('lessons.create', compact('course'));
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
        $lesson = $course->lessons()->create($data);
        //notify students of lesson created
        $users = $course->users;
        foreach ($users as $user) {
            if ($user->pivot->role == 'student') {
                $user->notify(new LessonCreated($lesson));
          
            }
         
        }
        return redirect("lessons/$lesson->id")->with('success',"$lesson->title has been created !");
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Lesson $lesson)
    {
        return view('lessons.show', compact('lesson'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Lesson $lesson)
    {   
        return view('lessons.edit',compact('lesson'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lesson $lesson)
    {
        //return 'works';
        $data = $this->validateRequest($request);
        $lesson->update($data);
        return redirect("$lesson->path")->with('success',"$lesson->title has been updated !");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lesson $lesson)
    {
        $course_id = $lesson->course->id;
        $lesson_title = $lesson->title;
        $lesson->delete();
        return redirect("lessons/$course_id/course")->with('success',"$lesson_title has been deleted !");
    }

    // search

    public function search(Request $request)
    {
        $title = $this->validateSearchRequest($request);
        
       
        return redirect("search_lessons/$title");
    }

    public function searchResults($title)
    {
        
        
        $lessons = Lesson::searchedLessons($title)->orderBy('created_at','desc')->paginate(10);
        //dd($courses);
        return view('lessons.search')->with('lessons',$lessons);
    }
    

    //Links
    public function create_link(Lesson $lesson)
    {
        return view('links.create',compact('lesson'));
    }

    public function store_link(Lesson $lesson, Request $request)
    {
        $data =  $this->validateLinkRequest($request);
        $link = $lesson->links()->create($data);
        return redirect("links/$lesson->id/course")->with('success',"A link has been added to $lesson->title");
    }

    public function links_index(Lesson $lesson)
    {
        $links = Link::where('lesson_id',$lesson->id)->orderBy('created_at','desc')->paginate(10);
        return view('links.index',compact('lesson','links'));
    }

    //files
    public function create_file(Lesson $lesson)
    {
        return view('files.create',compact('lesson'));
    }

    public function store_file(Lesson $lesson, Request $request)
    {
        //dd('works');
        $data = $this->validateFileRequest($request);
        //dd($request->file('upload'));
        $file = $lesson->files()->create([
            'text' => $data['text'],
            'name'=> $data['upload']->store('uploads','public')
        ]);
        return redirect("/lessons/$lesson->id")->with('success',"$file->text has been succesfully uploaded !");
    }

    public function files_index(Lesson $lesson)
    {
        $files = File::where('lesson_id',$lesson->id)->orderBy('created_at','desc')->paginate(10);
        //return $files;
        return view('files.index',compact('lesson','files'));
    }






    //Validation of Requests
    private function validateRequest($request){
        return $request->validate([
            'title'=>'required',
            'content'=>'required',
            
            

        ]);

    }

    private function validateSearchRequest($request){
        $data = $request->validate([
            'title'=>'required',
            

        ]);
        return $data['title'];

    }

    private function validateLinkRequest($request){
        return $request->validate([
            'text'=>'required',
            'url'=>'required|url',
            

        ]);

    }

    private function validateFileRequest($request){
        //dd($request->hasFile('upload'));
        if ($request->hasFile('upload')) {
            //return 2;
            return $request->validate([
                'text'=>'required',
                'upload'=>'file|mimes:jpeg,jpg,png|max:5000',
                
    
            ]);
        }
        
        

    }


}
