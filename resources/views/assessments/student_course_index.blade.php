@extends('layouts.app')
@section('title')
  {{$course->title}} - assessments

    
@endsection

@section('content')

  <!-- Extra Navigation--> 
  <div class="container mb-5">
    <small class="float-left text-warning"><a class="text-warning" href="{{route('courses.show',$course->id)}}">{{$course->title}} </a>> Student Assessment</small>
    <a href="{{url()->previous()}}" class="float-right">Go back</a>
    
  </div>
  @include('inc.messages')

  <!-- main activity -->
  <div class="container my-5 py-5">
    <!--heading -->
    <h1 class="title font-weight-bold" style="color: #024089">{{$student->name}}</h1>
    <h1 class="float-right text-capitalize">Grade - {{$student->grade}}</h1>
    
    <div style="background: #edcb23; height: 2px; width:90px;" class="ml-2"></div>

    
    <!-- table for submissions -->
    <div class="container py-4 table-responsive mt-3">
        <table class="table table-striped table-hover text-center table-bordered">
            <thead class="thead-dark">
                <tr>
                    
                    <th colspan= 3>{{$course->title}} - Continuous Assessment</th>
                    
                
                    
                </tr>
                <tr>
                    <th>Activity</th>
                    <th>Score</th>
                    
                </tr>
               

                

            <tbody>
                
                @foreach ($activities as $activity)
                <tr>
                    <th>
                      <a href="{{route('activity.submissions.student',[$activity->id, $student->id])}}">{{$activity->title}}</a> 
                  
                      
                    </th>
                    <td>
                        {{$activity->studentScore}}/{{$activity->contribution_to_course_assessment}} 
                    </td>
                </tr>
                  
               @endforeach
               <tr>
                   <th>
                       Total
                   </th>
                   <td>{{$student->total}}/{{$course->activities->sum('contribution_to_course_assessment')}}</td>
               </tr>
                    
               
            </tbody>
        </table>
    </div>

    
    
</div>

@endsection