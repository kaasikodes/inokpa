@extends('layouts.app')
@section('title')
  {{$activity->title}} - submissions

    
@endsection

@section('content')

  <!-- Extra Navigation--> 
  <div class="container mb-5">
    <small class="float-left text-warning"><a class="text-warning" href="{{route('courses.show',$activity->course->id)}}">{{$activity->course->title}} </a>> {{$activity->title}} </small>
    <a href="{{url()->previous()}}" class="float-right">Go back</a>
    
  </div>
  @include('inc.messages')


  <!-- main section -->
  <div class="container my-5 py-5 mb-5">
    <!--heading -->
    <div class="container-fluid d-flex justify-content-between">
        <div>
            <h3>{{$student->name}}</h3>
            
        </div>

        <div class="text-right">
            <h2 class=" bg-secondary text-white-50 px-3 py-2">{{$activity->course->title}}</h2>
        </div>
    </div>

    <h2 class="text-primary text-center m-0 mt-5 p-0">{{$activity->title}}</h2>

    
    <!-- table for submissions -->
    <div class="container py-4 table-responsive">
        <table class="table table-striped table-hover text-center table-bordered">
            <thead class="thead-light">
                <tr>
                    <th></th>
                    <th>Category</th>
                    <th>No. of questions Answered</th>
                    <th>Grading Status</th>
                    <th></th>
                </tr>
               
            </thead>

            <tbody>
                @foreach ($sections as $section)
                  <tr>
                      <th>{{$section->title}}</th>
                      <td>{{$section->category}} </td>
                      <td>{{$section->no_of_questions_answered}} out of {{$section->questions->count()}}</td>
                      <td>{{$section->gradingStatus}}</td>
                      <td>
                          <a href="{{$section->anyQuestionAnswered ? route('assessments.create', [$section->id, $student->id]) : '#'}}" class="btn {{$section->anyQuestionAnswered ? 'btn-success' : 'btn-danger'}}">
                            {{$section->anyQuestionAnswered ? 'Grade' : 'Empty'}}
                         </a>
                    </td><!-- depdnt on the grading status-->
                  </tr>
                    
                @endforeach
               
            </tbody>
        </table>
    </div>

    
    
</div>

@endsection