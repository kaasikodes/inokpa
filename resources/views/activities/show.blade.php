@extends('layouts.app')
@section('title')
  Activity - {{$activity->title}}

    
@endsection

@section('content')

  <!-- Extra Navigation--> 
  <div class="container mb-5">
    <small class="float-left text-warning"><a class="text-warning" href="{{route('courses.show',$activity->course->id)}}">{{$activity->course->title}} </a>> {{$activity->title}} </small>
    <a href="{{url()->previous()}}" class="float-right">Go back</a>
    
  </div>
  @include('inc.messages')
  <!-- Main Section -->
  <div class="container py-4">
    
    <!-- 3 section content -->
    <div class="row justify-content-center">


      <!--Management Section -->
      @if (Auth::user()->courses->where('id',$activity->course->id)->first())
          @if (Auth::user()->courses->where('id',$activity->course->id)->first()->pivot->role == 'teacher')
              <div class="col-lg-3 d-flex flex-column">
                <!-- spacing -->
                <div class="container" style="height: 71px;">
        
                
                </div>
                <!-- create section -->
                <div class="container custom-bg py-3">
                  <a href="{{route('sections.create',$activity->id)}}" class="dropdown-item text-center text-primary" style="display: flex; "> 
                    <div style="border: 1px solid; border-radius:50%; width: 2rem; height: 2rem; display:flex; justify-content: center; align-items:center;">
                        <i class="fas fa-plus"></i>
                    </div>
                    <span class="pl-1" style="align-self: center;">Add section</span>
                  </a>
        
                  
                  
        
        
                </div>
                <div style="background: #edcb23; height: 2px;" class="w-100 mx-auto"></div>
        
                <!-- manage section -->
                <div class="container custom-bg py-3">
                  <h6 class="text-left text-primary font-weight-bold ml-4 mb-0" style="font-size: 1rem;">MANAGE</h6>
                  <div style="background: #edcb23; height: 1.4px;" class="w-25 ml-4 mx-right mb-1"></div>
        
                  <a href="{{route('sections.index',$activity->id)}}" class="dropdown-item text-left text-primary">> Sections</a>
                  <a href="{{route('activity.submissions', $activity->id)}}" class="dropdown-item text-left text-primary">> Submissions</a>
                  <a href="{{route('assessments.activity_index',$activity->id)}}" class="dropdown-item text-left text-primary">> Assessments</a>
                  
                  
        
        
                </div>
        
                
        
              </div>
              
          @endif
            
        
            
      @endif
      



      <!--Cotent Section -->
      <div class="{{Auth::user()->courses->where('id',$activity->course->id)->first() ? (Auth::user()->courses->where('id',$activity->course->id)->first()->pivot->role == 'student'? 'col-lg-9': 'col-lg-6'): 'col-lg-9'}} px-1 d-flex flex-column">
        <!-- heading -->
        <div class="container mb-4 text-center">

          <h1 class="text-center font-weight-bold">{{$activity->course->title}} - {{$activity->title}}</h1>
          <div style="background: #edcb23; height: 2px;" class="w-50 mx-auto"></div>
          <small class="text-center text-muted">Author - {{$activity->course->users->first()->name}} | belongs to {{$activity->course->title}}</small>

        </div>
        <!-- edit n deete -->
        @if (Auth::user()->courses->where('id',$activity->course->id)->first())
          @if (Auth::user()->courses->where('id',$activity->course->id)->first()->pivot->role == 'teacher')
              <div class="container  py-3">

                <a href="{{route('activities.edit',$activity->id)}}" class="btn btn-success float-left">Edit</a>

                {!!Form::open(['action' => ['ActivitiesController@destroy',$activity->id],'class'=> 'float-right'])!!}
                {{Form::hidden('_method','DELETE')}}
                @csrf
            
                {{Form::submit('Delete', ['class'=>' btn btn-danger'])}}
                {!!Form::close()!!}
              </div>
              
          @endif
            
        
            
        @endif
        
        <!-- description -->
        @if (Auth::user()->courses->where('id',$activity->course->id)->first())
        <div class="container custom-bg p-3">
        
          <h3 class="pt-1  text-black-50 text-center">Instruction</h3>
          <div class="py-1">
          
            {!!$activity->instruction!!}
          </div>


        </div>
        <!-- enroll now form -->
        
          @if (Auth::user()->courses->where('id',$activity->course->id)->first()->pivot->role == 'student')
            <div class="container-fluid d-flex mt-3 justify-content-center">
              <p>Study well and leave the rest to God!</p>
            </div>
          @else<!-- if a teacher -->
          <div class="container-fluid d-flex mt-3 justify-content-center bg-primary text-center text-white p-0 pt-2 ">
            <p>This was created was {{$activity->created_at->diffForHumans()}}</p>
          </div>
               
              
              
          


          @endif
        @else<!-- if a neither a teacher or a student or a user -->

        <div class="container-fluid d-flex mt-3 justify-content-center  custom-bg py-3">
          <p>You are not a student of this course <a href="{{route('courses.show',$activity->course->id)}}"> Click here to enroll</a></p>
        </div>


        
            
        
            
        @endif
        
        
        
      </div>


      <!--Outine Section -->
      <div class="col-lg-3 d-flex flex-column">
        <!-- spacing 
        <div class="container" style="height: 71px;">

         
        </div>-->
        
        <!-- sections section -->
        <div class="container custom-bg py-3">
          <h6 class="text-left text-primary font-weight-bold ml-4 mb-0" style="font-size: 1.1rem;">Sections</h6>
          <div style="background: #edcb23; height: 1.4px;" class="w-50 ml-4 mx-right mb-1"></div>
            @if ($activity->sections->count() > 0)
                @foreach ($activity->sections as $section)
                    <a href="{{route('answers.create',$section->id)}}" class="dropdown-item text-left text-primary">> {{$section->title}}</a>
                    
                @endforeach
                
            @else
            <a href="#" class="dropdown-item text-left text-primary" disabled>No section Available</a>
                
            @endif

          
          
          
          


        </div>


      </div>


    </div>
    
  </div>
    
@endsection
    
