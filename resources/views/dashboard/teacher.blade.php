@extends('layouts.app')
@section('title')
 Teacher - Dashboard
    
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
              <h2>{{$teacher->name}}</h2>
              <small>Teaching {{count($courses)}} courses</small>
          </div>
          <div class="col-md-8"></div>
      </div>
  </div>

  <div class="container">
      

      <!-- grids -->
      <div class="container">
          <div class="row">
              <div class="col-md-3 mt-3">
                
                <!-- create section -->
                <div class="container custom-bg py-3">
                  <a href="{{route('courses.create')}}" class="dropdown-item text-center text-primary" style="display: flex; "> 
                    <div style="border: 1px solid; border-radius:50%; width: 2rem; height: 2rem; display:flex; justify-content: center; align-items:center;">
                        <i class="fas fa-plus"></i>
                    </div>
                    <span class="pl-1" style="align-self: center;">Create Course</span>
                  </a>
        
        
                </div>
                <div style="background: #edcb23; height: 2px;" class="w-100 mx-auto"></div>
        
                <!-- manage section -->
                <div class="container custom-bg py-3">
                  <h6 class="text-left text-primary font-weight-bold ml-4 mb-0" style="font-size: 1rem;">MANAGE</h6>
                  <div style="background: #edcb23; height: 1.4px;" class="w-25 ml-4 mx-right mb-1"></div>
        
                  <a href="{{route('courses.teacher_index')}}" class="dropdown-item text-left text-primary">> Courses</a>
                  <a href="{{route('lessons.teacher_index')}}" class="dropdown-item text-left text-primary">> Lessons</a>
                  <a href="{{route('activities.teacher_index')}}" class="dropdown-item text-left text-primary">> Activities</a>
                  <!--<a href="#" class="dropdown-item text-left text-primary">> Submissions</a>-->
                  
                  
                  
        
        
                </div>
                <div style="background: #edcb23; height: 2px;" class="w-100 mx-auto"></div>
                 <!-- Notifications -->
                 @if (Auth::user()->unReadNotifications->count() > 0)
                 <div class="container custom-bg pt-2">
                    <a href="{{route('notifications.index')}}" class="dropdown-item text-left text-primary">> 
                        Notifications
                        <span class="badge badge-warning">{{Auth::user()->unReadNotifications->count()}}</span>
                    </a>
          
          
                  </div>
                     
                 @endif
                 
        

                  
              </div>
              <div class="col-md-9  mt-5 mt-md-0">
                  <!-- heading -->
                <div class="container text-center text-bold text-secondary">
                    <h3>Teacher Dashboard</h3>
                </div>
                  <div class="table-reponsive">
                      <table class="table table-striped table-bordered">
                          <thead>
                              <tr class="thead-dark text-center">
                                  <th colspan="5">Courses Assessment</th>

                              </tr>
                              <tr>
                                  <th></th>
                                  <th>No. of Students</th>
                                  <th>No. of activities </th>
                                  <th>Course Assessment Completion Rate (%)</th>
                                  <th></th>
                                  
                              </tr>
                         </thead>

                         <tbody>
                             
                             @foreach ($courses as $course)
                             <tr>
                                 <th>
                                     <a href="{{route('courses.show',$course->id)}}">{{$course->title}}</a>
                                  </th>
                                  <td>{{$course->no_of_students_available}}</td>
                                  <td>{{$course->activities->count()}}</td>
                                  <td><small>{{$course->assessmentCompletionRate}} out of 100 </small>
                                        <div class="card w-100 ">
                                            <div class="bg-success" style="height: 10px; width: {{$course->assessmentCompletionRate}}%;"></div>
                                        </div>
                                    
                                   </td>
                                  <td>
                                      <a href="{{route('assessments.course_index',$course->id)}}" class="btn btn-sm btn-success">View</a>
                                  </td>
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