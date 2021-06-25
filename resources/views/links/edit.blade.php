@extends('layouts.app')
@section('title')
  Edit Link

    
@endsection

@section('content')
    <!-- Extra Navigation--> 
    <div class="container mb-5">
        <small class="float-left text-warning">{{$link->lesson->course->title}} > {{$link->lesson->title}} > update link</small>
        <a href="{{url()->previous()}}" class="float-right">Go back</a>
        
    </div>

    <!-- Main Section -->
    @include('inc.messages')
    <div class="container py-4">
        
        <h1 class="text-muted mb-4">{{$link->lesson->title}} - Edit Link</h1>
        <form action="{{route('links.update',$link->id)}}" method="POST">

            <div class="form-group">
                {{Form::label('text', 'Text to be displayed')}}
                {{Form::text('text', $link->text,['class'=>'form-control','placeholder'=>'Enter the text you want to be displayed for this link'])}}
            </div>

            <div class="form-group">
                {{Form::label('url', 'Url')}}
                {{Form::text('url', $link->url,['class'=>'form-control','placeholder'=>'Enter the url of the link'])}}
            </div>
        
            @method('PUT')
            
            @csrf
            
           
            
            
            {{Form::submit('Update', ['class'=>'btn btn-primary'])}}
        


           

        
        
        
        </form>
    </div>
@endsection