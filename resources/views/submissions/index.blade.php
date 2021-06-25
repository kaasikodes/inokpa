@extends('layouts.app')
@section('title')
  {{$activity->title}} - submissions

    
@endsection

@section('content')
@include('inc.messages')
  <!-- Extra Navigation--> 
  <div class="container mb-5">
    <small class="float-left text-warning"><a class="text-warning" href="{{route('courses.show',$activity->course->id)}}">{{$activity->course->title}} </a>> {{$activity->title}} </small>
    <a href="{{url()->previous()}}" class="float-right">Go back</a>
    
  </div>

  <!-- main section -->
  <div class="container my-5 py-5">
    <!--heading -->
    <h1 class="title font-weight-bold" style="color: #024089">{{$activity->title}} - Submissions</h1>
    <div style="background: #edcb23; height: 2px; width:90px;" class="ml-2"></div>

    <!--search-->
    <div class="container-fluid px-0" id="search">
        <div class="row">
            <div class="col-md-8"></div>
            <div class="col-md-4 d-flex justify-content-md-end footer-newsletter" >
                <form action="{{route('activities.search')}}" method="POST">
                    <input type="text" name="title" id="" placeholder="Enter name of student">
                    @csrf
                    <input type="submit" value="Search" name="search">
                </form>
            </div>
        </div>
    </div>
    <!-- table for submissions -->
    <div class="container py-4 table-responsive">
        <table class="table table-striped table-hover text-center table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th></th>
                    <th colspan="{{$activity->sections->count()}}">No of Questions Answered</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>

                <tr>
                    <th class="text-left">Name</th>
                    @foreach ($activity->sections as $section)
                      <th>{{$section->title}} <br> 
                        <small>Category - {{$section->category}}</small> <br>
                        <small>(out of {{$section->questions->count()}})</small>
                      </th>
                        
                    @endforeach
                    <th>Uploads</th>
                    <th>Grading Status</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @foreach ($students as $student)
                  <tr>
                     
                       <td class="text-left">{{$student->name}}</td>
                       @foreach ($activity->sections as $section)
                         <td>{{$student->answers->where('section_id',$section->id)->count()}}</td>
                            
                       @endforeach
                       <td>{{$student->files ? $student->files->where('activity_id',$activity->id)->count() : 'None'}}</td>
                       <td>{{$student->gradingStatus}}</td>
                       <td><a href="{{route('activity.submissions.student',[$activity->id, $student->id])}}" class="btn btn-success">View</a></td>
                       
                          
                     
                      
                  </tr>
                    
                @endforeach
            </tbody>
        </table>
    </div>

    
    
</div>

@endsection