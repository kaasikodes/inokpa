@extends('layouts.app')
@section('title')
  Create Lesson

    
@endsection

@section('content')
    <!-- Extra Navigation--> 
    <div class="container mb-5">
        <small class="float-left text-warning">{{$course->title}} > new lesson</small>
        <a href="{{url()->previous()}}" class="float-right">Go back</a>
        
    </div>

    <!-- Main Section -->
    <div class="container py-4">
        <h1 class="text-muted mb-4">{{$course->title}} - Create Lesson</h1>
        <form action="{{route('lessons.store',$course->id)}}" method="POST">

            <div class="form-group">
                {{Form::label('title', 'Title')}}
                {{Form::text('title', '',['class'=>'form-control','placeholder'=>'Title'])}}
            </div>
        
            <div class="form-group">
                {{Form::label('content', 'Content')}}
                {{Form::textarea('content','' ,['id'=>'content','class'=>'form-control','placeholder'=>'content'])}}
            </div>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor 4
                // instance, using default configuration.
                CKEDITOR.replace( 'content' );
            </script>
        
            
            @csrf
            
           
            
            
            {{Form::submit('Create', ['class'=>'btn btn-primary'])}}
        


           

        
        
        
        </form>
    </div>
@endsection