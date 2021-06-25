@extends('layouts.app')
@section('title')
  Edit Page

    
@endsection

@section('content')
@if (Auth::user()->email != 'caasithecreator@gmail.com')
  <div class="container text-center p-3">
      <h2 class="mt-4">Access Denied !</h2>
  </div>
    
@else
    <!-- Extra Navigation--> 
    <div class="container mb-5">
            
        <a href="{{url()->previous()}}" class="float-right">Go back</a>
        
    </div>

    <!-- Main Section -->
    <div class="container py-4">
        <h1 class="text-muted mb-4">edit Page</h1>
        @include('inc.messages')
        <form action="{{route('pages.store')}}" method="POST">

            <div class="form-group">
                {{Form::label('title', 'Title')}}
                {{Form::text('page-indicator', $page->title,['class'=>'form-control','placeholder'=>'Title', 'disabled'])}}
            </div>
            <input type="hidden" name="title" value="{{$page->title}}">
        
            <div class="form-group">
                {{Form::label('content', 'content')}}
                {{Form::textarea('content',$page->content ,['id'=>'content','class'=>'form-control','placeholder'=>'content'])}}
            </div>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor 4
                // instance, using default configuration.
                CKEDITOR.replace( 'content' );
            </script>
        
            
            @csrf
            @method('PUT')
        
            
            
            {{Form::submit('Update', ['class'=>'btn btn-primary'])}}
        


        

        
        
        
        </form>
    </div>
        
    @endif
    
@endsection