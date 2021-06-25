@extends('layouts.app')
@section('title')
  Create section

    
@endsection

@section('content')
@include('inc.messages')
    <!-- Extra Navigation--> 
    <div class="container mb-5">
        <small class="float-left text-warning">{{$activity->course->title}} > new section</small>
        <a href="{{url()->previous()}}" class="float-right">Go back</a>
        
    </div>

    <!-- Main Section -->
    <div class="container py-4">
        <h1 class="text-muted mb-4">{{$activity->title}} - Create section</h1>
        <form action="{{route('sections.store',$activity->id)}}" method="POST">

            <div class="form-group">
                {{Form::label('title', 'Title')}}
                {{Form::text('title', '',['class'=>'form-control','placeholder'=>'Title'])}}
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

            <div class="form-inline">
                <div class="form-group">
                    {{Form::label('time_duration', 'Time Duration (in hour and minutes)')}}
                    
                    <input type="time" name="time_duration" id="" value="02:20" class="ml-2 form-control">

                    
                    
                </div>

            </div>

            <div class="form-group">
                <label for="category">Category</label>
                <select name="category" id="" class="form-control">
                    <option value=""  selected disabled>Select a Category</option>
                    <option value="MCQ">MCQ</option>
                    <option value="Theory">Theory</option>
                    <option value="Uploads">Uploads</option>
                </select>
            </div>

            <div class="form-group">
                <label for="contribution_to_activity">What is the contribution of this section to the whole activity</label>
                <input type="number" name="contribution_to_activity" id="" class="form-control" min="0" max="100">
            </div>

            
        
            
            @csrf
            
           
            
            
            {{Form::submit('Create', ['class'=>'btn btn-primary'])}}
        


           

        
        
        
        </form>
    </div>
@endsection