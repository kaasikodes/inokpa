@extends('layouts.app')

@section('title')
    Sections
@endsection

@section('content')
@include('inc.messages')
  <div class="container my-5 py-2">
      <!--heading -->
      <h1 class="title font-weight-bold" style="color: #024089">{{$activity->title}} - sections</h1>
      <div style="background: #edcb23; height: 2px; width:90px;" class="ml-2"></div>

      

      <!-- sections -->
      @if (isset($sections))

        @if (count($sections) > 0)
            <div class="row my-4">
                {!!$sections->links('pagination::bootstrap-4')!!}
                @foreach ($sections as $section)
                  
                   <div class="col-md-12">
                       <div class="card mb-4 custom-bg-3 p-2 px-4 mt-4">
                           
                        <div class="card-body">
                            <div class="container-fluid p-0">
                                <!-- heading -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="card-title text-white m-0 p-0">
                                            {{$section->title}}
                                        
                                        </h4>
                                        <small class="text-white-50" style="margin-top:-1rem;">Created {{$section->created_at->diffForHumans() }} | belongs to {{$section->activity->title}}</small>
                                    </div>
                                    <div class="col-md-6 d-flex justify-content-md-end align-items-center justify-content-start">
                                        @if (Auth::user()->courses->where('id',$section->activity->course->id)->first()->pivot->role == 'teacher')
                                            <a href="{{route('sections.show',$section->id)}}" class="btn btn-warning  ml-md-4 mr-2 mr-md-0">Manage</a>
                                        @else
                                        <a href="{{route('sections.show',$section->id)}}" class="btn btn-warning  ml-md-4 mr-2 mr-md-0">Start</a>
                                        @endif
                                                                            
                                    </div>
                                </div>
                                
                            </div>


                            
                            
                          </div>
                           
                       </div>
                   </div>
                
                @endforeach
                {!!$sections->links('pagination::bootstrap-4')!!}
            </div>
            
            
        @else
            <p class="py-4 text-center">There are no sections</p>
            
        @endif
          
      @endif
      
  </div>
    
@endsection