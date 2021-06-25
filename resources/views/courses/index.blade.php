@extends('layouts.app')

@section('title')
    Courses
@endsection

@section('content')
@include('inc.messages')
  <div class="container my-5 py-2">
      <!--heading -->
      <h1 class="title font-weight-bold" style="color: #024089">Courses</h1>
      <div style="background: #edcb23; height: 2px; width:90px;" class="ml-2"></div>

      <!--search-->
      <div class="container-fluid px-0" id="search">
          <div class="row">
              <div class="col-md-8"></div>
              <div class="col-md-4 d-flex justify-content-md-end footer-newsletter" >
                  <form action="{{route('courses.search')}}" method="POST">
                      <input type="text" name="title" id="" placeholder="Enter name of course">
                      @csrf
                      <input type="submit" value="Search" name="search">
                  </form>
              </div>
          </div>
      </div>

      <!-- courses -->
      @if (isset($courses))

        @if (count($courses) > 0)
            <div class="row my-4">
                {!!$courses->links('pagination::bootstrap-4')!!}
                @foreach ($courses as $course)
                  
                   <div class="col-md-12">
                       <div class="card mb-4 custom-bg-3 p-2 px-4 mt-4">
                           
                        <div class="card-body">
                            <div class="container-fluid p-0">
                                <!-- heading -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="card-title text-white m-0 p-0">
                                            {{$course->title}}
                                        
                                        </h4>
                                        <small class="text-white-50" style="margin-top:-1rem;">Created {{$course->created_at->diffForHumans() }} by {{$course->users->first()->name}}</small>
                                    </div>
                                    <div class="col-md-6 d-flex justify-content-md-end align-items-center justify-content-start">
                                        <a href="/courses/{{$course->id}}" class="btn btn-warning  ml-md-4 mr-2 mr-md-0">Check Me Out !</a>
                                        <!--<a href="#" class="btn btn-success  ml-md-4 mr-2 mr-md-0">Enroll now</a>-->
                                    </div>
                                </div>
                                
                            </div>


                            <hr>
                            
                            <!--description-->
                            <div class="card-text text-white-50">{!!substr($course->description,0,200)!!}... <a href="/courses/{{$course->id}}">read more</a></div>
                            
                          </div>
                           
                       </div>
                   </div>
                
                @endforeach
                {!!$courses->links('pagination::bootstrap-4')!!}
            </div>
            
            
        @else
            <p class="py-4 text-center">There are no courses</p>
            
        @endif
          
      @endif
      
  </div>
    
@endsection