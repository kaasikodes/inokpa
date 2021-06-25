@extends('layouts.app')
@section('title')
  Create Link

    
@endsection

@section('content')
    <!-- Extra Navigation--> 
    <div class="container mb-5">
        <small class="float-left text-warning">{{$lesson->course->title}} > {{$lesson->title}} > new link</small>
        <a href="{{url()->previous()}}" class="float-right">Go back</a>
        
    </div>

    <!-- Main Section -->
    @include('inc.messages')
    <div class="container py-4">
        
        <h1 class="text-muted mb-4">{{$lesson->title}} - Create Link</h1>
        <form action="{{route('links.store',$lesson->id)}}" method="POST">

            <div class="form-group">
                {{Form::label('text', 'Text to be displayed')}}
                {{Form::text('text', '',['class'=>'form-control','placeholder'=>'Enter the text you want to be displayed for this link'])}}
            </div>

            <div class="form-group">
                {{Form::label('url', 'Url')}}
                {{Form::text('url', '',['class'=>'form-control','placeholder'=>'Enter the url of the link'])}}
            </div>
        
            
            
            @csrf
            
           
            
            
            {{Form::submit('Create', ['class'=>'btn btn-primary'])}}
        


           

        
        
        
        </form>
    </div>
@endsection