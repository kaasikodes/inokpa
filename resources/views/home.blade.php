@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header custom-bg text-center text-primary">Welcome, {{Auth::user()->name}}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="alert alert-success alert-dismissible mb-3">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                         <a href="{{route('developer.hire')}}">Discuss Project with Developer !</a>
                     
                     
                    </div>

                    
                     <!-- options container -->
                     <div class="container mx-auto">
                        <a href="{{ route('courses.create') }}" class="btn btn-primary mb-4" style="display: flex;"> 
                            <div style="border: 1px solid; border-radius:50%; width: 2rem; height: 2rem; display:flex; justify-content: center; align-items:center;">
                                <i class="fas fa-plus"></i>
                            </div>
                            <span class="pl-1" style="align-self: center;">Create Course</span>
                        </a>

                        <div class="d-flex  flex-row align-items-center justify-content-center">
                            <a href="{{ route('courses.index') }}" class="btn btn-warning mr-5">
                                Check out Courses
                            </a>
                            <a href="{{route('dashboard.student')}}" class="btn btn-success mr-5">
                                Student Dashboard
                            </a>
                            <a href="{{route('dashboard.teacher')}}" class="btn btn-success">
                                Teacher Dashboard
                            </a>
                            
                        </div>


                        


                 </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
