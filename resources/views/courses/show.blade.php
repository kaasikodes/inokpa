@extends('layouts.app')
@section('title')
  Course - {{$course->title}}

    
@endsection

@section('content')

  <!-- Extra Navigation--> 
  <div class="container mb-5">
    <small class="float-left text-warning"><a class="text-warning" href="/courses">Courses </a>> {{$course->title}} </small>
    <a href="{{url()->previous()}}" class="float-right">Go back</a>
    
  </div>
  @include('inc.messages')
  <!-- Main Section -->
  <div class="container py-4">
  <p> the number of students are {{$course->no_of_students}}</p>
    @auth
    
    <!-- 3 section content -->
    <div class="row justify-content-center">
      


      <!--Management Section -->
      @if (Auth::user()->courses->where('id',$course->id)->first())
          @if (Auth::user()->courses->where('id',$course->id)->first()->pivot->role == 'teacher')
              <div class="col-lg-3 d-flex flex-column">
                <!-- spacing -->
                <div class="container" style="height: 71px;">
        
                
                </div>
                <!-- create section -->
                <div class="container custom-bg py-3">
                  <a href="{{route('lessons.create',$course->id)}}" class="dropdown-item text-center text-primary" style="display: flex; "> 
                    <div style="border: 1px solid; border-radius:50%; width: 2rem; height: 2rem; display:flex; justify-content: center; align-items:center;">
                        <i class="fas fa-plus"></i>
                    </div>
                    <span class="pl-1" style="align-self: center;">Create Lesson</span>
                  </a>
        
                  <a href="{{route('activities.create',$course->id)}}" class="dropdown-item text-center text-primary" style="display: flex; "> 
                      <div style="border: 1px solid; border-radius:50%; width: 2rem; height: 2rem; display:flex; justify-content: center; align-items:center;">
                          <i class="fas fa-plus"></i>
                      </div>
                      <span class="pl-1" style="align-self: center;">Create Activity</span>
                  </a>
                  
        
        
                </div>
                <div style="background: #edcb23; height: 2px;" class="w-100 mx-auto"></div>
        
                <!-- manage section -->
                <div class="container custom-bg py-3">
                  <h6 class="text-left text-primary font-weight-bold ml-4 mb-0" style="font-size: 1rem;">MANAGE</h6>
                  <div style="background: #edcb23; height: 1.4px;" class="w-25 ml-4 mx-right mb-1"></div>
        
                  <a href="{{route('lessons.course_index',$course->id)}}" class="dropdown-item text-left text-primary">> Lessons</a>
                  <a href="{{route('activities.course_index',$course->id)}}" class="dropdown-item text-left text-primary">> Activities</a>
                  <a href="{{route('assessments.course_index',$course->id)}}" class="dropdown-item text-left text-primary">> Continuous Assessment</a>
                  
                  <!--<a href="#" class="dropdown-item text-left text-primary">> Students</a>-->
                  
        
        
                </div>
        
                
        
              </div>
              
          @endif
            
        
            
      @endif
      



      <!--Content Section -->
      
      <div class="{{Auth::user()->courses->where('id',$course->id)->first() ? (Auth::user()->courses->where('id',$course->id)->first()->pivot->role == 'student'? 'col-lg-9': 'col-lg-6'): 'col-lg-9'}} px-1 d-flex flex-column">
        <!-- edit n deete -->
        @if (Auth::user()->courses->where('id',$course->id)->first())
          @if (Auth::user()->courses->where('id',$course->id)->first()->pivot->role == 'teacher')
              <div class="container  py-3">

                <a href="{{url('courses/'.$course->id.'/edit')}}" class="btn btn-success float-left">Edit</a>
                {!!Form::open(['action' => ['CoursesController@destroy',$course->id],'class'=> 'float-right'])!!}
                {{Form::hidden('_method','DELETE')}}
                @csrf
            
                {{Form::submit('Delete', ['class'=>' btn btn-danger'])}}
                {!!Form::close()!!}
              </div>
              
          @endif
            
        
            
        @endif
        
        <!-- description -->
        <!-- heading -->
        <div class="container mb-3">

          <h1 class="text-center font-weight-bold">{{$course->title}}</h1>
          <div style="background: #edcb23; height: 2px;" class="w-50 mx-auto"></div>

        </div>
        <div class="container p-0 pb-3">
          <div style="width: 100%;">
            <img src="{{asset('storage/'.$course->image)}}" alt="" class="img-fluid" style="width:100%">
          </div>
          <h3 class="pt-2  text-black-50 text-center">Course Description</h3>
          
          <div class="px-3 py-1">
            {!!$course->description!!} 
          </div>
          


        </div>
        <!-- enroll now form -->
        @if (Auth::user()->courses->where('id',$course->id)->first())
          @if (Auth::user()->courses->where('id',$course->id)->first()->pivot->role == 'student')
            
            <div class="container-fluid d-flex mt-5 justify-content-center p-3" style="border-radius: 10px; border-top: solid 2px #02418912;">
              <a href="{{route('activities.course_index',$course->id)}}" class="btn btn-primary mr-4">Activities</a>
              <a href="{{route('lessons.course_index',$course->id)}}" class="btn btn-primary mr-4">Lessons</a>
              <a href="{{route('assessments.student_course_index',[$course->id,Auth::user()->id])}}" class="btn btn-primary mr-4">Assessments</a>
            </div>
            <div style="height: 1.4px;" class="w-100 custom-bg mt-5"></div>

            <a href="{{route('courses.unenroll',$course->id)}}" class="text-danger mt-2">Click here to drop this Course</a>
          @else<!-- if a teacher -->
          <div class="container-fluid d-flex mt-3 justify-content-center bg-primary text-center text-white p-0 pt-2 ">
            <p>The Enrollment key for this course is - "{{$course->enrollmentKey}}"</p>
          </div>
               
              
              
          


          @endif
        @else<!-- if a neither a teacher or a student or a user -->


        <form action="{{route('courses.enroll',$course)}}" method="post" class="mt-4">
          <div class="form-group mb-1">
            <input type="text" name="password" id="" class="form-control" placeholder="Enter the enrollment key">
          </div>
          @csrf
          <button type="submit" class="btn btn-primary mt-0 container-fluid">Enroll now</button>
        
        </form>
            
        
            
        @endif
        
        
        
      </div>


      <!--Outine Section -->
      <div class="col-lg-3 d-flex flex-column  mt-5 mt-lg-0">
        <!-- spacing 
        <div class="container" style="height: 71px;">

         
        </div>-->
        <!-- manage section -->
        <div class="container custom-bg py-3">
          <h6 class="text-left text-primary font-weight-bold ml-4 mb-0" style="font-size: 1.1rem;">Course Outline</h6>
          <div style="background: #edcb23; height: 1.4px;" class="w-50 ml-4 mx-right mb-1"></div>
          <!--This serves the sole purpose of joining all lessons and activities and spitting them out -->

          @if ($course->lessons->count() > 0)
              @foreach ($course->lessons as $lesson)
              <a href="{{$lesson->path}}" class="dropdown-item text-left text-primary">> {{$lesson->title}}</a>
                  
              @endforeach
              
          @else
            <a href="" class="dropdown-item text-left text-primary" disabled>No Lessons </a>
              
          @endif


          
          
          
          


        </div>

      </div>


    </div>
    @else
    <div class="row">
      <!-- content section -->
      <div class="col-lg-9">
        <!-- heading -->
        <div class="container mb-3">

          <h1 class="text-center font-weight-bold">{{$course->title}}</h1>
          <div style="background: #edcb23; height: 2px;" class="w-50 mx-auto"></div>

        </div>
        <div class="container p-0 pb-3">
          <div style="width: 100%;">
            <img src="{{asset('storage/'.$course->image)}}" alt="" class="img-fluid" style="width:100%">
          </div>
          <h3 class="pt-2  text-black-50 text-center">Course Description</h3>
          
          <div class="px-3 py-1">
            {!!$course->description!!} 
          </div>
          


        </div>
        <div class="mt-4">
          
          <a href="{{route('login')}}" class="btn btn-primary mt-0 container-fluid">Click here to Login</a>
         
        
        </div>
        
      </div>


      <!--Outine Section -->
      <div class="col-lg-3 d-flex flex-column  mt-5 mt-lg-0">
        <!-- spacing 
        <div class="container" style="height: 71px;">

        
        </div>-->
        <!-- manage section -->
        <div class="container custom-bg py-3">
          <h6 class="text-left text-primary font-weight-bold ml-4 mb-0" style="font-size: 1.1rem;">Course Outline</h6>
          <div style="background: #edcb23; height: 1.4px;" class="w-50 ml-4 mx-right mb-1"></div>
          <!--This serves the sole purpose of joining all lessons and activities and spitting them out -->

          @if ($course->lessons->count() > 0)
              @foreach ($course->lessons as $lesson)
              <a href="{{$lesson->path}}" class="dropdown-item text-left text-primary">> {{$lesson->title}}</a>
                  
              @endforeach
              
          @else
            <a href="" class="dropdown-item text-left text-primary" disabled>No Lessons </a>
              
          @endif


          
          
          
          


        </div>

      </div>
    </div>
    @endauth
    
  </div>
    
@endsection
    
