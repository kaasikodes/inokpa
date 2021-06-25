@extends('layouts.app')
@section('title')
  Edit file

    
@endsection

@section('content')
    <!-- Extra Navigation--> 
    <div class="container mb-5">
        <small class="float-left text-warning">{{$file->lesson->course->title}} > {{$file->lesson->title}} > update file</small>
        <a href="{{url()->previous()}}" class="float-right">Go back</a>
        
    </div>

    <!-- Main Section -->
    @include('inc.messages')
    <div class="container py-4">
        
        <h1 class="text-muted mb-4">{{$file->lesson->title}} - Edit file</h1>
        <form action="{{route('files.update',$file->id)}}" method="POST">

            <div class="form-group">
                {{Form::label('text', 'Text to be displayed')}}
                {{Form::text('text', $file->text,['class'=>'form-control','placeholder'=>'Enter the text you want to be displayed for this file'])}}
            </div>

            
        
            @method('PUT')
            
            @csrf
            
           
            
            
            {{Form::submit('Update', ['class'=>'btn btn-primary'])}}
        


           

        
        
        
        </form>
    </div>
@endsection