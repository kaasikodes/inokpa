@extends('layouts.app')

@section('title')
    My lessons
@endsection

@section('content')
@include('inc.messages')
  <div class="container my-5 py-2">
      <!--heading -->
      <h1 class="title font-weight-bold" style="color: #024089">My lessons <br>
        <small class="text-muted" style="font-size: 1.4rem">As a teacher</small>
      
     </h1>
      
      <!--search-->
      <div class="container-fluid px-0" id="search">
          <div class="row">
              <div class="col-md-8"></div>
              <div class="col-md-4 d-flex justify-content-md-end footer-newsletter" >
                  <form action="{{route('lessons.search')}}" method="POST">
                      <input type="text" name="title" id="" placeholder="Enter name of lesson">
                      @csrf
                      <input type="submit" value="Search" name="search">
                  </form>
              </div>
          </div>
      </div>

      <!-- lessons -->
      @if (isset($lessons))

        @if (count($lessons) > 0)
            <div class="row my-4">
                
                @foreach ($lessons as $lesson)
                  
                   <div class="col-md-12">
                       <div class="card mb-4 custom-bg-3 p-2 px-4 mt-4">
                           
                        <div class="card-body">
                            <div class="container-fluid p-0">
                                <!-- heading -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="card-title text-white m-0 p-0">
                                            {{$lesson->title}}
                                        
                                        </h4>
                                        <small class="text-white-50" style="margin-top:-1rem;">
                                            Created {{$lesson->created_at->diffForHumans() }} by {{$lesson->course->users->first()->name}} | belongs to {{$lesson->course->title}}
                                        </small>
                                    </div>
                                    <div class="col-md-6 d-flex justify-content-md-end align-items-center justify-content-start">
                                        <a href="{{$lesson->path}}" class="btn btn-success  ml-md-4 mr-2 mr-md-0">View</a>
                                        <!--<a href="#" class="btn btn-success  ml-md-4 mr-2 mr-md-0">Enroll now</a>-->
                                    </div>
                                </div>
                                
                            </div>


                            <hr>
                            
                            <!--description-->
                            <div class="card-text text-white-50">{!!substr($lesson->description,0,200)!!}... <a href="/lessons/{{$lesson->id}}">read more</a></div>
                            
                          </div>
                           
                       </div>
                   </div>
                
                @endforeach
                
            </div>
            
            
        @else
            <p class="py-4 text-center">There are no lessons</p>
            
        @endif
          
      @endif
      
  </div>
    
@endsection