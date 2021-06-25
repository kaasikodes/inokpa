@extends('layouts.app')
@section('title')
  lesson - {{$lesson->title}}

    
@endsection

@section('content')

  <!-- Extra Navigation--> 
  <div class="container mb-5">
    <small class="float-left text-warning">
      <a class="text-warning" href="{{route('courses.show',$lesson->course->id)}}">{{$lesson->course->title}} ></a>
      <span class="text-muted"> Lesson </span> </small>
    <a href="{{url()->previous()}}" class="float-right">Go back</a>
    
  </div>
  @include('inc.messages')

  <!-- Main Section -->
  <div class="container py-4">
    
    <!-- 3 section content -->
    <div class="row justify-content-center">


      <!--Management Section -->
      @if (Auth::user()->courses->where('id',$lesson->course->id)->first())
          @if (Auth::user()->courses->where('id',$lesson->course->id)->first()->pivot->role == 'teacher')
              <div class="col-lg-3 d-flex flex-column">
                <!-- spacing -->
                <div class="container" style="height: 71px;">
        
                
                </div>
                <!-- create section -->
                <div class="container custom-bg py-3">
                  <a href="{{route('links.create',$lesson->id)}}" class="dropdown-item text-center text-primary" style="display: flex; "> 
                    <div style="border: 1px solid; border-radius:50%; width: 2rem; height: 2rem; display:flex; justify-content: center; align-items:center;">
                        <i class="fas fa-plus"></i>
                    </div>
                    <span class="pl-1" style="align-self: center;">Add Link</span>
                  </a>
        
                  <a href="{{route('files.create',$lesson->id)}}" class="dropdown-item text-center text-primary" style="display: flex; "> 
                      <div style="border: 1px solid; border-radius:50%; width: 2rem; height: 2rem; display:flex; justify-content: center; align-items:center;">
                          <i class="fas fa-plus"></i>
                      </div>
                      <span class="pl-1" style="align-self: center;">Add File(s)</span>
                  </a>
                  
        
        
                </div>
                <div style="background: #edcb23; height: 2px;" class="w-100 mx-auto"></div>
        
                <!-- manage section -->
                <div class="container custom-bg py-3">
                  <h6 class="text-left text-primary font-weight-bold ml-4 mb-0" style="font-size: 1rem;">MANAGE</h6>
                  <div style="background: #edcb23; height: 1.4px;" class="w-25 ml-4 mx-right mb-1"></div>
        
                  <a href="{{route('links.index',$lesson->id)}}" class="dropdown-item text-left text-primary">> Links</a>
                  <a href="{{route('files.index',$lesson->id)}}" class="dropdown-item text-left text-primary">> Files</a>
                  
                  
        
        
                </div>
        
                
        
              </div>
              
          @endif
            
        
            
      @endif
      



      <!--Cotent Section -->
      <div class="{{Auth::user()->courses->where('id',$lesson->course->id)->first() ? (Auth::user()->courses->where('id',$lesson->course->id)->first()->pivot->role == 'student'? 'col-lg-9': 'col-lg-6'): 'col-lg-9'}} px-1 d-flex flex-column mt-5 mt-0">
        <!-- edit n deete -->
        @if (Auth::user()->courses->where('id',$lesson->course->id)->first())
          @if (Auth::user()->courses->where('id',$lesson->course->id)->first()->pivot->role == 'teacher')
              <div class="container  py-3">

                <a href="{{route('lessons.edit',[$lesson->id,$lesson->title])}}" class="btn btn-success float-left">Edit</a>

                {!!Form::open(['action' => ['LessonsController@destroy',$lesson->id],'class'=> 'float-right'])!!}
                {{Form::hidden('_method','DELETE')}}
                @csrf
            
                {{Form::submit('Delete', ['class'=>' btn btn-danger'])}}
                {!!Form::close()!!}
              </div>
              
          @endif
            
        
            
        @endif
        
        <!-- description -->
        @if (Auth::user()->courses->where('id',$lesson->course->id)->first())
        <!-- heading -->
        <div class="container mb-4 text-center">

          <h1 class="text-center text-muted">{{$lesson->course->title}} </h1>
          <div style="background: #edcb23; height: 2px;" class="w-50 mx-auto"></div>
          <h2 class="text-primary font-weight-bold text-center mt-4 mb-0 ">{{$lesson->title}}</h2>
          
          <small class="text-center text-muted">Author - {{$lesson->course->users->first()->name}} | belongs to {{$lesson->course->title}}</small>

        </div>
        <div class="container custom-bg p-3">
        
          
          <div class="py-1">
          
            {!!$lesson->content!!}
          </div>


        </div>
        <!-- enroll now form -->
        
          @if (Auth::user()->courses->where('id',$lesson->course->id)->first()->pivot->role == 'student')
            <div class="container-fluid d-flex mt-3 justify-content-center">
              <!-- not needed now <p>Study well and leave the rest to God!</p>-->
            </div>
          @else<!-- if a teacher -->
          <div class="container-fluid d-flex mt-3 justify-content-center bg-primary text-center text-white p-0 pt-2 ">
            <p>This was created {{$lesson->created_at->diffForHumans()}}</p>
          </div>
               
              
              
          


          @endif
        @else<!-- if a neither a teacher or a student or a user -->

        <div class="container-fluid d-flex mt-3 justify-content-center  custom-bg py-3">
          <p>You are not a student of this course <a href="{{route('courses.show',$lesson->course->id)}}"> Click here to enroll</a></p>
        </div>


        
            
        
            
        @endif
        
        
        
      </div>


      <!--Outine Section -->
      <div class="col-lg-3 d-flex flex-column mt-5 mt-0">
        <!-- spacing 
        <div class="container" style="height: 71px;">

         
        </div>-->
        <!-- lesson material section -->
        <div class="container custom-bg py-3">
          <h6 class="text-left text-primary font-weight-bold ml-4 mb-0" style="font-size: 1.1rem;">Lesson Material</h6>
          <div style="background: #edcb23; height: 1.4px;" class="w-50 ml-4 mx-right mb-1"></div>
          <!--This serves the sole purpose of joining all lessons and activities and spitting them out -->

          @if ($lesson->files->count() > 0)
              @foreach ($lesson->files as $file)
                  <a href="{{route('files.download',$file->id)}}" class="dropdown-item text-left text-primary">> {{$file->text}}</a>
                  
              @endforeach
              
          @else
          <a href="#" class="dropdown-item text-left text-primary" disabled>No Material Available</a>
              
          @endif
          
          
          


        </div>

        <!-- links section -->
        <div class="container custom-bg pb-3">
          <h6 class="text-left text-primary font-weight-bold ml-4 mb-0" style="font-size: 1.1rem;">Links</h6>
          <div style="background: #edcb23; height: 1.4px;" class="w-50 ml-4 mx-right mb-1"></div>
          <!--This serves the sole purpose of joining all lessons and activities and spitting them out -->

          @if ($lesson->links->count() > 0)

            @foreach ($lesson->links as $link)
              <a href="{{Auth::user()->courses->where('id',$lesson->course->id)->first() ? $link->url : ''}}" class="dropdown-item text-left text-primary" disabled>> {{$link->text}}</a>
                
            @endforeach
              
          @else
          <a href="#" class="dropdown-item text-left text-primary" disabled>No Links Available</a>
              
          @endif

          
          
          
          
          


        </div>


      </div>


    </div>
    
  </div>
    
@endsection
    
