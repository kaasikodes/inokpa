<nav class="navbar navbar-expand-md navbar-light navbar-laravel" style="z-index: 5000; background:none; box-shadow:none;">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}" style="width:5.8rem;">
            <img src="{{asset('img/logo.svg')}}" alt="" class="" style="width: 100%; ">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- General Links-->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Start Learning
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="{{ route('courses.index') }}">Courses</a>
                      <a class="dropdown-item" href="{{ route('lessons.index') }}">Lessons</a>
                      
                      <a class="dropdown-item" href="{{ route('activities.index') }}">Activities</a>
                      
                    </div>
                </li>
                <!--<li class="nav-item">
                    <a class="nav-link" href="">Blog</a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link" href="{{route('developer.hire')}}">Hire Me</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('developer.support')}}">Support</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('pages.page','about')}}">About</a>
                </li>

                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Sign Up</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a href="{{ route('courses.create') }}" class="dropdown-item text-center" style="display: flex;"> 
                                <div style="border: 1px solid; border-radius:50%; width: 2rem; height: 2rem; display:flex; justify-content: center; align-items:center;">
                                    <i class="fas fa-plus"></i>
                                </div>
                                <span class="pl-1" style="align-self: center;">Create Course</span>
                            </a>

                            
                            <div class="dropdown-divider"></div>

                            <a href="{{route('dashboard.student')}}" class="dropdown-item">Student Dashboard</a>
                            <a href="{{route('dashboard.teacher')}}" class="dropdown-item">Teacher Dashboard</a>
                            
                            @if (Auth::user()->unReadNotifications->count() > 0)
                            <div class="dropdown-divider"></div>
                            <!-- use blade templates for the notification -->    
                            <a href="{{route('notifications.index')}}" class="dropdown-item bg-primary text-white">

                                Notifications
                                <span class="badge badge-warning">{{Auth::user()->unReadNotifications->count()}}</span>
                                
                            </a>
                            @endif

                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>