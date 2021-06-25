@extends('layouts.app')
@section('title')
  {{$course->title}} - assessments

    
@endsection

@section('content')

  <!-- Extra Navigation--> 
  <div class="container mb-5">
    <small class="float-left text-warning"><a class="text-warning" href="{{route('courses.show',$course->id)}}">{{$course->title}} </a>> Assessments</small>
    <a href="{{url()->previous()}}" class="float-right">Go back</a>
    
  </div>
  @include('inc.messages')

  <!-- main activity -->
  <div class="container my-5 py-5">
    <!--heading -->
    <h1 class="title font-weight-bold" style="color: #024089">{{$course->title}} - Assessments</h1>
    <div style="background: #edcb23; height: 2px; width:90px;" class="ml-2"></div>

    <!--search-->
    
    <!-- table for submissions -->
    <div class="container py-4 table-responsive">
        <table class="table table-striped table-hover text-center table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th></th>
                    <th colspan="{{count($activities)}}">Score of student in each activity</th>
                    <th></th>
                    <th></th>
                
                    
                </tr>

                <tr>
                    <th class="text-left">Name</th>
                    @foreach ($activities as $activity)
                      <th>  <a href="{{route('activities.show',$activity->id)}}">{{$activity->title}}</a> <br> 
                        
                        <small>(out of {{$activity->contribution_to_course_assessment}})%</small>
                      </th>
                        
                    @endforeach
                    <th>Total <br>
                        <small>( {{$course->activities->sum('contribution_to_course_assessment')}} out of 100)%</small>
                    </th>
                    
                    <th>Grade</th>
                    
                </tr>
            </thead>

            <tbody>
                @foreach ($students as $student)
                  <tr>
                     
                       <td class="text-left"><a href="{{route('assessments.student_course_index',[$course->id,$student->id])}}" class="">{{$student->name}}</a></td>
                       @foreach ($student->activities as $activity)
                         <td>{{$activity}}</td>
                           
                       @endforeach
                       <td>{{$student->total}} out of {{$course->activities->sum('contribution_to_course_assessment')}}</td> 
                       <td class="text-capitalize">{{$student->grade}}</td>
                      
                    
                       
                     
                      
                  </tr>
                    
                @endforeach
            </tbody>
        </table>
    </div>

    
    
</div>

@endsection