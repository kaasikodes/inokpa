@extends('layouts.app')
@section('title')
  Create Course

    
@endsection

@section('content')
    <!-- Extra Navigation--> 
    <div class="container mb-5">
        <small class="float-left text-warning">Courses > new course</small>
        <a href="{{url()->previous()}}" class="float-right" >Go back</a>
        
    </div>
    @include('inc.messages')
    {{-- <!-- Main Section -->+++++ DONT TOUCH DONT TOUCH DONT TOUCH DONT TOUCH DONT TOUCH DONT TOUCHDONT TOUCH DONT TOUCH DONT TOUCH--}}
    <div class="container py-4">
        <h1 class="text-muted mb-4">Create Course</h1>
        
        <form action="{{route('courses.store')}}" method="POST" enctype="multipart/form-data">

            <div class="form-group">
                {{Form::label('title', 'Title')}}
                {{Form::text('title', '',['class'=>'form-control','placeholder'=>'Title'])}}
            </div>
        
            <div class="form-group">
                {{Form::label('description', 'Description')}}
                {{Form::textarea('description','' ,['id'=>'description','class'=>'form-control','placeholder'=>'Description'])}}
            </div>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor 4
                // instance, using default configuration.
                CKEDITOR.replace( 'description' );
            </script>
        
            <div class="form-group">
                {{Form::label('enrollmentKey', 'Enrollment Key')}}
                {{Form::text('enrollmentKey', '',['class'=>'form-control','placeholder'=>'Password for course enrollment'])}}
            </div>
            <div class="form-group">
                {{Form::label('maxNoOfStudents', 'Maximum number of students')}}
                {{Form::text('maxNoOfStudents','' ,['class'=>'form-control','placeholder'=>'Set a limit to numer of students'])}}
            </div>

            <div class="form-group">
                <label for="image">Insert your Course Profile Image</label>
                <input type="file" name="image" id="" class="form-control"> 
            </div>


            @csrf
            
           
            
            
            {{Form::submit('Create', ['class'=>'btn btn-primary'])}}
        


           

        
        
        
        </form>
    </div>
@endsection