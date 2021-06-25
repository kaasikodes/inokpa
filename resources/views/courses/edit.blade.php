@extends('layouts.app')
@section('title')
  Edit - {{$course->title}}

    
@endsection

@section('content')
    <!-- Extra Navigation--> 
    <div class="container mb-5">
        <small class="float-left text-warning"><a class="text-warning" href="/courses">Courses </a>> {{$course->title}} </small>
        <a href="{{url()->previous()}}" class="float-right">Go back</a>
        
    </div>

    <!-- Main Section -->
    <div class="container py-4">
        <h1 class="text-muted mb-4">Edit Course: <span class="text-primary">{{$course->title}}</span> </h1>
        @include('inc.messages')
        <form action="{{route('courses.update',$course)}}" method="POST" enctype="multipart/form-data">

            <div class="form-group">
                {{Form::label('title', 'Title')}}
                {{Form::text('title', $course->title,['class'=>'form-control','placeholder'=>'Title'])}}
            </div>
        
            <div class="form-group">
                {{Form::label('description', 'Description')}}
                {{Form::textarea('description', $course->description,['id'=>'description','class'=>'form-control','placeholder'=>'Description'])}}
            </div>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor 4
                // instance, using default configuration.
                CKEDITOR.replace( 'description' );
            </script>
        
            <div class="form-group">
                {{Form::label('enrollmentKey', 'Enrollment Key')}}
                {{Form::text('enrollmentKey', $course->enrollmentKey,['class'=>'form-control','placeholder'=>'Password for course enrollment'])}}
            </div>
            <div class="form-group">
                {{Form::label('maxNoOfStudents', 'Maximum number of students')}}
                {{Form::text('maxNoOfStudents', $course->maxNoOfStudents,['class'=>'form-control','placeholder'=>'Set a limit to numer of students'])}}
            </div>

            <div class="form-group">
                <label for="image">Replace your Course Profile Image</label>
                <input type="file" name="image" id="" class="form-control"> 
            </div>
            @csrf
            {{Form::hidden('_method','PUT')}}
           
            
            
            {{Form::submit('Update', ['class'=>'btn btn-primary'])}}
        


           

        
        
        
        </form>
    </div>
@endsection