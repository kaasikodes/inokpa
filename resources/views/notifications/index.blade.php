@extends('layouts.app')

@section('title')
    Notifications
@endsection

@section('content')
@include('inc.messages')
  <div class="container my-5 py-2">
      <!--heading -->
      <h1 class="title font-weight-bold" style="color: #024089">Notifications</h1>
      <div style="background: #edcb23; height: 2px; width:90px;" class="ml-2"></div>

      <!--search-->
      <div class="container-fluid px-0" id="search"><!-- should use js -->
          <div class="row">
              <div class="col-md-8"></div>
              <div class="col-md-4 d-flex justify-content-md-end footer-newsletter" >
                  <form action="" method="POST">
                      <input type="text" name="title" id="" placeholder="Enter name of notification">
                      @csrf
                      <input type="submit" value="Search" name="search">
                  </form>
              </div>
          </div>
      </div>

      <!-- notifications -->
      @if (isset($notifications))

        @if (count($notifications) > 0)
            <div class="row my-4">
               
                @foreach ($notifications as $notification)
                  
                   <div class="col-md-12">
                       <div class="card mb-4 custom-bg-3 p-2 px-4 mt-4">
                           
                        <div class="card-body">
                            <div class="container-fluid p-0">
                                <!-- heading -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="card-title text-white m-0 p-0">
                                            {{$notification->data['text']}}
                                        
                                        </h4>
                                        <small class="text-white-50" style="margin-top:-1rem;">Created {{$notification->created_at->diffForHumans() }} </small>
                                    </div>
                                    <div class="col-md-6 d-flex justify-content-md-end align-items-center justify-content-start">
                                        <a href="{{isset($notification->data['url']) ? $notification->data['url'] : '#'}}" class="btn btn-success  ml-md-4 mr-2 mr-md-0">View</a>
                                        <!--<a href="#" class="btn btn-success  ml-md-4 mr-2 mr-md-0">Enroll now</a>-->
                                    </div>
                                </div>
                                
                            </div>


                            <hr>
                            
                            <!--description-->
                            <div class="card-text text-white-50"></div>
                            
                          </div>
                           
                       </div>
                   </div>
                
                @endforeach
                
            </div>
            
            
        @else
            <p class="py-4 text-center">There are no notifications</p>
            
        @endif
          
      @endif
      
  </div>
    
@endsection