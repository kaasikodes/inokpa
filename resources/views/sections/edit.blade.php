@extends('layouts.app')
@section('title')
  Edit section

    
@endsection

@section('content')

    <!-- Extra Navigation--> 
    <div class="container mb-5">
        <small class="float-left text-warning">{{$section->activity->course->title}} > Edit {{$section->title}}</small>
        <a href="{{url()->previous()}}" class="float-right">Go back</a>
        
    </div>
    @include('inc.messages')

    <!-- Main Section -->
    <div class="container py-4">
        <h1 class="text-muted mb-4">{{$section->activity->title}} - Edit section</h1>
        <form action="{{route('sections.update',$section->id)}}" method="POST">

            <div class="form-group">
                {{Form::label('title', 'Title')}}
                {{Form::text('title', $section->title,['class'=>'form-control','placeholder'=>'Title'])}}
            </div>
        
            <div class="form-group">
                {{Form::label('instruction', 'Instruction')}}
                {{Form::textarea('instruction',$section->instruction ,['id'=>'instruction','class'=>'form-control','placeholder'=>'instruction'])}}
            </div>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor 4
                // instance, using default configuration.
                CKEDITOR.replace( 'instruction' );
            </script>

            <div class="form-inline">
                <div class="form-group">
                    {{Form::label('time_duration', 'Time Duration (in hour and minutes)')}}
                    
                    <input type="time" name="time_duration" id="" value="{{$actual_time}}" class="ml-2 form-control">

                    
                    
                </div>
               

            </div>

            <div class="form-group">
                <label for="category">Category</label>
                <select name="category" id="" class="form-control">
                    <option value="{{$section->category}}"  selected >{{$section->category}}</option>
                    <!-- not allowed to choose another category -->
                </select>
            </div>

            <div class="form-group">
                <label for="contribution_to_activity">What is the contribution of this section to the whole activity</label>
                <input type="number" name="contribution_to_activity" id="" class="form-control" min="0" max="100" value="{{$section->contribution_to_activity}}">
            </div>

            
        
            
            @csrf
            @method('PUT')
           
            
            
            {{Form::submit('Update', ['class'=>'btn btn-primary'])}}
        


           

        
        
        
        </form>
    </div>
@endsection

