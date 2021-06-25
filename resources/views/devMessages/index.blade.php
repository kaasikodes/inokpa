@extends('layouts.app')

@section('title')
    Messages
@endsection

@section('content')
@include('inc.messages')
  <div class="container my-5 py-2">
      <!--heading -->
      <h1 class="title font-weight-bold" style="color: #024089">Messages</h1>
      <div style="background: #edcb23; height: 2px; width:90px;" class="ml-2"></div>

     
      <!-- messages -->
      @if (isset($messages))

        @if (count($messages) > 0)
            <div class="row my-4">
                {!!$messages->links('pagination::bootstrap-4')!!}
                @foreach ($messages as $message)
                  
                   <div class="col-md-12">
                       <div class="card mb-4 custom-bg-3 p-2 px-4 mt-4">
                           
                        <div class="card-body">
                            <div class="container-fluid p-0">
                                <!-- heading -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="card-title text-white m-0 p-0">
                                            {{$message->name}}
                                        
                                        </h4>
                                        <small class="text-white-50" style="margin-top:-1rem;">Created {{$message->created_at->diffForHumans() }}|Category - {{$message->type}}</small>
                                    </div>
                                    <div class="col-md-6 d-flex justify-content-md-end align-items-center justify-content-start">
                                        <a href="mailto:{{$message->email}}" class="btn btn-warning  ml-md-4 mr-2 mr-md-0">Email</a>
                                        <a href="tel:{{$message->phone}}" class="btn btn-success  ml-md-4 mr-2 mr-md-0">Phone</a>
                                    </div>
                                </div>
                                
                            </div>


                            <hr>
                            
                            <!--description-->
                            <div class="card-text text-white-50">
                                 <p>{{$message->message}}</p> 
                            </div>
                            
                          </div>
                           
                       </div>
                   </div>
                
                @endforeach
                {!!$messages->links('pagination::bootstrap-4')!!}
            </div>
            
            
        @else
            <p class="py-4 text-center">There are no messages</p>
            
        @endif
          
      @endif
      
  </div>
    
@endsection