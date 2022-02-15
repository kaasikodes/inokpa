<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Notifications\StudentEnrolled;
use App\Notifications\StudentRemoved;
use App\Events\CourseCreatedWithImage;

class CoursesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(
            'auth',[
            'except'=>['index','search','searchResults','show']
            ]
        );
        // $this->middleware('test'); //testing middleware
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::with('users')->orderBy('created_at','desc')->paginate(10);
        //dd(Course::with('users')->orderBy('created_at','desc')->get())   ;
        return view('courses.index',compact('courses'));
    }

    public function student_index()
    {
        //return 'wo';
        $courses = auth()->user()->courses;
        $studentCourses = [];
        foreach ($courses as $course) {
            if ($course->pivot->role == 'student') {
                $studentCourses[] = $course;
            }
        }
        $courses = $studentCourses;
        
        //dd(Course::with('users')->orderBy('created_at','desc')->get())   ;
        return view('courses.student_index',compact('courses'));
    }

    public function teacher_index()
    {
        //return 'wo';
        $courses = auth()->user()->courses;
        $teacherCourses = [];
        foreach ($courses as $course) {
            if ($course->pivot->role == 'teacher') {
                $teacherCourses[] = $course;
            }
        }
        $courses = $teacherCourses;
        
        //dd(Course::with('users')->orderBy('created_at','desc')->get())   ;
        return view('courses.teacher_index',compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('courses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validateRequest($request);
        $user_id = auth()->user()->id;
        $course = Course::create($data);
        $course ->users()
                ->syncWithoutDetaching([
                    $user_id =>[
                        'role'=>'teacher'
                    ]
        ]);
                  

        //add profile image if available
        //dd( $this->validateFileRequest($request));
        if ($data = $this->validateFileRequest($request)) {
             $course->update([
                'image'=>$data['image']->store('course_images','public'),
                'mini_image'=>$data['image']->store('mini_images','public')
            ]);
            //resize image to make ui smooth - courses.show
            event(new CourseCreatedWithImage($course));
            
           
           

        }
        //return $course;
        return redirect('/courses')->with('success',"$course->title created");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        return view('courses.show',compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        if(auth()->user()->id !== $course->user_id){ 
            return redirect('/courses')->with('success',"not allowed");
        };
        return view('courses.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Course $course)
    {
        
        $data = $this->validateRequest($request);
        
        $course->update($data);
        //add profile image if available
        // delete image first
        if ($course->image) {
           
            Storage::delete("public/$course->image");
        }
        
        if ($data = $this->validateFileRequest($request)) {
            $course->update([
                'image'=>$data['image']->store('course_images','public'),
                'mini_image'=>$data['image']->store('mini_images','public')
            ]);
            //resize image to make ui smooth - courses.show
            event(new CourseCreatedWithImage($course));
            
        }
        
        
        return redirect("/courses/$course->id")->with('success',"$course->title updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $title = $course->title;
        // delete image first
        if ($course->image) {
            Storage::delete("public/$course->image");
        }
        if ($course->lessons->count() > 0) {// make this a  private method too much repitiion
            foreach ($course->lessons as $lesson) {
                if ($lesson->links->count() > 0) {
                    foreach ($lesson->links as $link) {
                        $link->delete();
                    }
                }
                
                if ($lesson->files->count() > 0) {
                    foreach ($lesson->files as $file) {
                        $file->delete();
                    }
                }
                
                $lesson->delete();
                # code...
            }
        }
        foreach ($course->activities as $activity) {
            $activity->delete();
        }
        $course->delete();
        return redirect("/courses")->with('success',"$title has been successfully deleted");
    }

    // search

    public function search(Request $request)
    {
        $title = $this->validateSearchRequest($request);
        
       
        return redirect("search_courses/$title");
    }

    public function searchResults($title)
    {
        
        
        $courses = Course::searchedCourses($title)->orderBy('created_at','desc')->paginate(10);
        //dd($courses);
        return view('courses.search')->with('courses',$courses);
    }

    //adding a student


    public function enrollAStudent(Course $course, Request $request)
    {
        // check if the maximum number of students is exceeded
        if (!empty($course->maxNoOfStudents)) {
            $currentNoOfStudents = 0;
            $courseMaxNoOfStudents = $course->maxNoOfStudents;
            $users = $course->users;
            foreach ($users as $user) {
                if($user->pivot->role == 'student'){
                    $currentNoOfStudents++;
                }
            }
            if ($currentNoOfStudents == $courseMaxNoOfStudents) {
                return back()->with('error','Sorry, the mamximum number of students allowed for this course has been reached!');
            }
        }
       
        
        $password = $this->validatePasswordRequest($request);
        if ($password == $course->enrollmentKey) {
            $user_id = auth()->user()->id;
            $user_name = auth()->user()->name;
            $course->users()
                   ->syncWithoutDetaching([
                       $user_id =>[
                           'role'=>'student'
                       ]
            ]);
            // Notify teachers that a student has been added
            $users = $course->users;
            foreach ($users as $user) {
                if ($user->pivot->role == 'teacher') {
                    $user->notify(new StudentEnrolled(auth()->user(),$course));
                }
                # code...
            }

                    
            return back()->with('success',"Congrats, $user_name, you are now a student of $course->title");
        }
        return back()->with('error','Please type in the correct enrollment key');
    }


    public function unenrollAStudent(Course $course)
    {
       
        
        $user_id = auth()->user()->id;
        $user_name = auth()->user()->name;
        $course->users()
                ->detach(auth()->user());
        // Notify teachers that a student has been removed
        $users = $course->users;
        foreach ($users as $user) {
            if ($user->pivot->role == 'teacher') {
                $user->notify(new StudentRemoved(auth()->user(),$course));
            }
            # code...
        }

                
        return back()->with('success',"Congrats, $user_name, you are no longer a student of $course->title");
        
    }

    //validations

    private function validateRequest($request){
        return $request->validate([
            'title'=>'required',
            'description'=>'required',
            'enrollmentKey'=>'',
            'maxNoOfStudents'=>''

        ]);

    }

    private function validateSearchRequest($request){
        $data = $request->validate([
            'title'=>'required',
            

        ]);
        return $data['title'];

    }

    private function validatePasswordRequest($request){
        $data = $request->validate([
            'password'=>'required',
            

        ]);
        return $data['password'];

    }

    private function validateFileRequest($request){
        //dd($request->hasFile('image'));
        if ($request->hasFile('image')) {
            //return 2;
            return $request->validate([
                
                'image'=>'file|mimes:jpeg,jpg,png|max:12000',
                
    
            ]);
        }
       return false;
        
        

    }
}