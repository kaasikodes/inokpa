@extends('layouts.app')

@section('title')
    Links
@endsection

@section('content')
@include('inc.messages')
  <div class="container my-5 py-2">
      <!--heading -->
      <h1 class="title font-weight-bold" style="color: #024089">{{$lesson->title}} - links</h1>
      <div style="background: #edcb23; height: 2px; width:90px;" class="ml-2"></div>

      

      <!-- links -->
      @if (isset($links))

        @if (count($links) > 0)
            <div class="row my-4">
                {!!$links->links('pagination::bootstrap-4')!!}
                @foreach ($links as $link)
                  
                   <div class="col-md-12">
                       <div class="card mb-4 custom-bg-3 p-2 px-4 mt-4">
                           
                        <div class="card-body">
                            <div class="container-fluid p-0">
                                <!-- heading -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="card-title text-white m-0 p-0">
                                            {{$link->text}}
                                        
                                        </h4>
                                        <small class="text-white-50" style="margin-top:-1rem;">Created {{$link->created_at->diffForHumans() }}</small>
                                    </div>
                                    <div class="col-md-6 d-flex justify-content-md-end align-items-center justify-content-start">
                                        <a href="{{route('links.edit',$link->id)}}" class="btn btn-success  ml-md-4 mr-2 mr-md-0">Edit</a>
                                        
                                        {!!Form::open(['action' => ['LinksController@destroy',$link->id],'class'=> 'ml-md-4 mr-2 mr-md-0'])!!}
                                        {{Form::hidden('_method','DELETE')}}
                                        @csrf
                                    
                                        {{Form::submit('Delete', ['class'=>' btn btn-danger'])}}
                                        {!!Form::close()!!}
                                    </div>
                                </div>
                                
                            </div>


                            
                          </div>
                           
                       </div>
                   </div>
                
                @endforeach
                {!!$links->links('pagination::bootstrap-4')!!}
            </div>
            
            
        @else
            <p class="py-4 text-center">There are no links</p>
            
        @endif
          
      @endif
      
  </div>
    
@endsection