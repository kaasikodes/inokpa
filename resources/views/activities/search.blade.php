@extends('layouts.app')

@section('title')
    Activities - Search Results
@endsection

@section('content')
@include('inc.messages')
  <div class="container my-5 py-2">
      <!--heading -->
      <h1 class="title font-weight-bold" style="color: #024089">Activities - Search Results</h1>
      <div style="background: #edcb23; height: 2px; width:90px;" class="ml-2"></div>

      <!--search-->
      <div class="container-fluid px-0" id="search">
          <div class="row">
              <div class="col-md-8"></div>
              <div class="col-md-4 d-flex justify-content-md-end footer-newsletter" >
                  <form action="{{route('activities.search')}}" method="POST">
                      <input type="text" name="title" id="" placeholder="Enter name of activity">
                      @csrf
                      <input type="submit" value="Search" name="search">
                  </form>
              </div>
          </div>
      </div>

      <!-- activities -->
      @if (isset($activities))

        @if (count($activities) > 0)
            <div class="row my-4">
                {!!$activities->links('pagination::bootstrap-4')!!}
                @foreach ($activities as $activity)
                  
                   <div class="col-md-12">
                       <div class="card mb-4 custom-bg-3 p-2 px-4 mt-4">
                           
                        <div class="card-body">
                            <div class="container-fluid p-0">
                                <!-- heading -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="card-title text-white m-0 p-0">
                                            {{$activity->title}}
                                        
                                        </h4>
                                        <small class="text-white-50" style="margin-top:-1rem;">Created {{$activity->created_at->diffForHumans() }} by {{$activity->course->users->first()->name}} | belongs to {{$activity->course->title}}</small>
                                    </div>
                                    <div class="col-md-6 d-flex justify-content-md-end align-items-center justify-content-start">
                                        @guest
                                        
                                           <a href="{{route('courses.show',$activity->course->id)}}" class="btn btn-warning  ml-md-4 mr-2 mr-md-0">Check Me Out !</a>    
                                        @else
                                            @if (Auth::user()->courses->where('id',$activity->course->id)->first())
                                            @if (Auth::user()->courses->where('id',$activity->course->id)->first()->pivot->role == 'teacher')
                                                    <a href="{{route('activities.show',$activity->id)}}" class="btn btn-warning  ml-md-4 mr-2 mr-md-0">
                                                        Manage
                                                        
                                                    </a>
                                                
                                                    @else
                                                    <a href="{{route('activities.show',$activity->id)}}" class="btn btn-success  ml-md-4 mr-2 mr-md-0">Start</a>

                                                    @endif
                                        
                                        
                                            @endif
                                        @endguest
                                    </div>
                                </div>
                                
                            </div>


                            
                            
                          </div>
                           
                       </div>
                   </div>
                
                @endforeach
                {!!$activities->links('pagination::bootstrap-4')!!}
            </div>
            
            
        @else
            <p class="py-4 text-center">There are no activities</p>
            
        @endif
          
      @endif
      
  </div>
    
@endsection