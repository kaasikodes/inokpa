@extends('layouts.app')
@section('title')
  Edit Activity

    
@endsection

@section('content')
    <!-- Extra Navigation--> 
    <div class="container mb-5">
        <small class="float-left text-warning">{{$activity->course->title}} > new Activity</small>
        <a href="{{url()->previous()}}" class="float-right">Go back</a>
        
    </div>
    @include('inc.messages')

    <!-- Main Section -->
    <div class="container py-4">
        <h1 class="text-muted mb-4">{{$activity->course->title}} - Edit Activity({{$activity->title}})</h1>
        <form action="{{route('activities.update',$activity->id)}}" method="POST">

            <div class="form-group">
                {{Form::label('title', 'Title')}}
                {{Form::text('title', $activity->title,['class'=>'form-control','placeholder'=>'Title'])}}
            </div>

            <div class="form-group">
                {{Form::label('contribution_to_course_assessment', 'Contribution to Course Assessment')}}
                {{Form::number('contribution_to_course_assessment',$activity->contribution_to_course_assessment ,['class'=>'form-control','min'=>0,'placeholder'=>'contribution_to_course_assessment','max'=>(100 - $activity->course->activities->sum('contribution_to_course_assessment'))])}}
            </div>
        
            <div class="form-group">
                {{Form::label('instruction', 'Instruction')}}
                {{Form::textarea('instruction',$activity->instruction ,['id'=>'instruction','class'=>'form-control','placeholder'=>'instruction'])}}
            </div>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor 4
                // instance, using default configuration.
                CKEDITOR.replace( 'instruction' );
            </script>

            @method('PUT')
        
            
            @csrf
            
           
            
            
            {{Form::submit('Update', ['class'=>'btn btn-primary'])}}
        


           

        
        
        
        </form>
    </div>
@endsection