@extends('layouts.app')
@section('title')
  Create Lesson Material

    
@endsection

@section('content')
    <!-- Extra Navigation--> 
    <div class="container mb-5">
        <small class="float-left text-warning">{{$lesson->course->title}} > {{$lesson->title}} > new file</small>
        <a href="{{url()->previous()}}" class="float-right">Go back</a>
        
    </div>

    <!-- Main Section -->
    @include('inc.messages')
    <div class="container py-4">
        
        <h1 class="text-muted mb-4">{{$lesson->title}} - Create file</h1>
        <form action="{{route('files.store',$lesson->id)}}" method="POST" enctype="multipart/form-data">

            <div class="form-group">
                {{Form::label('text', 'Text to be displayed')}}
                {{Form::text('text', '',['class'=>'form-control','placeholder'=>'Enter the text you want to be displayed for this file'])}}
            </div>

            <div class="form-group">
                <label for="upload">Insert your file here</label>
                <input type="file" name="upload" id="" class="form-control"> 
            </div>
        
            
            
            @csrf
            
           
            
            
            {{Form::submit('Upload', ['class'=>'btn btn-primary'])}}
        


           

        
        
        
        </form>
    </div>
@endsection