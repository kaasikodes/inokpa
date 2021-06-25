@extends('layouts.app')
@section('title')
 Student - Dashboard
    
@endsection

@section('content')

@include('inc.messages')
    <!-- Extra Navigation--> 
    <div class="container my-5">
      
      <a href="{{url()->previous()}}" class="float-right">Go back</a>
      
    </div>

    <div class="container mb-5 pb-2">
        <div class="row">
            <div class="col-md-4">
                <h2>{{$student->name}}</h2>
                <small>Enrolled in {{count($courses)}} courses</small>
            </div>
            <div class="col-md-8"></div>
        </div>
    </div>

    <div class="container">
        

        <!-- grids -->
        <div class="container">
            <div class="row">
                <div class="col-md-3 mt-4">

                    <div class="container custom-bg py-3">
                        <h6 class="text-left text-primary font-weight-bold ml-4 mb-0" style="font-size: 1.1rem;">View</h6>
                        <div style="background: #edcb23; height: 1.4px;" class="w-50 ml-4 mx-right mb-1"></div>
                        <!--This serves the sole purpose of joining all lessons and activities and spitting them out -->
              
                        <a href="{{route('courses.student_index')}}" class="dropdown-item text-left text-primary">> My Courses</a>
                        <a href="{{route('lessons.student_index')}}" class="dropdown-item text-left text-primary">> My Lessons</a>
                        <a href="{{route('activities.student_index')}}" class="dropdown-item text-left text-primary">> Activities</a>
                        <!-- Notifications -->
                        @if (Auth::user()->unReadNotifications->count() > 0)
                        
                            <a href="{{route('notifications.index')}}" class="dropdown-item text-left text-primary">> 
                                Notifications
                                <span class="badge badge-warning">{{Auth::user()->unReadNotifications->count()}}</span>
                            </a>
                
                
                       
                            
                        @endif
                        
                        
                        
              
              
                    </div>
                </div>
                <div class="col-md-9 mt-5 mt-md-0">
                    <!-- heading -->
                    <div class="container text-center text-bold text-secondary">
                        <h3>Student Dashboard</h3>
                    </div>
                    <div class="table-reponsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr class="thead-dark text-center">
                                    <th colspan="4">Courses Overview</th>

                                </tr>
                                <tr>
                                    <th></th>
                                    <th>Course Assessment Completion Rate (%)</th>
                                    <th>Continuous Assessment so far (%)</th>
                                    <th>Grade</th>
                                </tr>
                           </thead>

                           <tbody>
                               
                               @foreach ($courses as $course)
                               <tr>
                                   <th>
                                       <a href="{{route('courses.show',$course->id)}}">{{$course->title}}</a>
                                    </th>
                                    <td><small>{{$course->assessmentCompletionRate}} out of 100 </small>
                                        <div class="card w-100 ">
                                            <div class="bg-success" style="height: 10px; width: {{$course->assessmentCompletionRate}}%;"></div>
                                        </div>
                                    
                                    </td>
                                    <td>{{$course->studentCASofar}} out of {{$course->assessmentCompletionRate}}</td>
                                    <td style="text-transform: capitalize;">{{$course->studentCourseGrade}}</td>
                               </tr>
                                   
                               @endforeach
                           </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    
@endsection