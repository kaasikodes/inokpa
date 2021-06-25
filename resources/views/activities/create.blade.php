@extends('layouts.app')
@section('title')
  Create Activity

    
@endsection

@section('content')
    <!-- Extra Navigation--> 
    <div class="container mb-5">
        <small class="float-left text-warning">{{$course->title}} > new Activity</small>
        <a href="{{url()->previous()}}" class="float-right">Go back</a>
        
    </div>
    @include('inc.messages')

    <!-- Main Section -->
    <div class="container py-4">
        <h1 class="text-muted mb-4">{{$course->title}} - Create Activity</h1>
        <form action="{{route('activities.store',$course->id)}}" method="POST">

            <div class="form-group">
                {{Form::label('title', 'Title')}}
                {{Form::text('title', '',['class'=>'form-control','placeholder'=>'Title'])}}
            </div>
            <div class="form-group">
                {{Form::label('contribution_to_course_assessment', 'Contribution to Course Assessment')}}
                {{Form::number('contribution_to_course_assessment','' ,['class'=>'form-control','placeholder'=>'contribution_to_course_assessment','min'=> 0,'max'=>(100 - $course->activities->sum('contribution_to_course_assessment'))])}}
            </div>
        
            <div class="form-group">
                {{Form::label('instruction', 'Instruction')}}
                {{Form::textarea('instruction','' ,['id'=>'instruction','class'=>'form-control','placeholder'=>'instruction'])}}
            </div>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor 4
                // instance, using default configuration.
                CKEDITOR.replace( 'instruction' );
            </script>
        
            
            @csrf
            
           
            
            
            {{Form::submit('Create', ['class'=>'btn btn-primary'])}}
        


           

        
        
        
        </form>
    </div>
@endsection