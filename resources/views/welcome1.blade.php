@extends('layouts.app')

@section('title')
 Home
    
@endsection

@section('content')
       
<!-- Hero -->
 @include('inc.hero')
<!-- Top Courses -->
<div class="container-fluid p-0 my-5 pt-4">
  <div class="container  mt-4">
    <h2 class="text-left font-weight-bold" style="color: #024089;">Our Top Courses</h2>

  </div>
  <div class="container-fluid mb-5 custom-bg" >
    <div class="container">
      
      @if (isset($courses))
        <div class="row pb-4">
          @for ($i = 0; $i < 6; $i++)
            <div class="col-md-6 col-12 col-lg-4 mt-4 px-4 py-5">
              <div class="card shadow-lg" >
                <img class="card-img-top" src="{{asset('storage/'.$courses[$i]->mini_image)}}" alt="Card image">
                <div class="card-body">
                  <div style="max-height: 50px;">
                    <h4 class="card-title">{{$courses[$i]->title}}</h4>
                  
                  </div>
                  <div style="height: 135px;">
                   
                    
                    <p class="card-text">{!!substr($courses[$i]->description,0,170)!!} ...</p>
                  
                  </div>
                  
                  <a href="{{route('courses.show',$courses[$i]->id)}}" class="btn btn-primary">Learn more</a>
                </div>
              </div>
            </div>
              
          @endfor
          
        </div>
          
      @endif
    </div>
  </div>

</div>

<!--Features of Kpa-->
<div class="container-fluid px-0 pt-4">
  <h2 class="text-center font-weight-bold mb-2" style="color: #024089;">WHAT MAKES INOKPA GREAT !</h2>
  <div class="icy-bg mt-3" >
    <div class="container" >
      @if (true)
        <div class="row" >
         <!-- feature 1 -->
            <div class="col-lg-3 col-md-6 mt-4 px-4 py-5">
              <div class="card shadow-sm text-center" >
                <div class="card-img-top p-3" style="background:#024089; height:95px;"><h4 class="card-title text-warning">Easy Result Compilation</h4></div>
                <div class="card-body mb-3 mt-1" style="height: 150px;">
                  
                  <p class="card-text">Compiling the results of a 1000 students can be a real pain in the ass. But,
                    with inokpa all that changes. 
                  </p>
                  
                </div>
              </div>
            </div>
            <!-- feature 2 -->
            <div class="col-lg-3 col-md-6 mt-4 px-4 py-5">
              <div class="card shadow-sm text-center" >
                <div class="card-img-top p-3" style="background:#024089; height:95px;"><h4 class="card-title text-warning">Automatic and Easy Grading</h4></div>
                <div class="card-body mb-3 mt-1" style="height: 150px;">
                  
                  <p class="card-text">Grading students, especially multiple choice questions can be mundane, but
                    this app does that automatically.
                  </p>
                  
                </div>
              </div>
            </div>
            <!-- feature 3 -->
            <div class="col-lg-3 col-md-6 mt-4 px-4 py-5">
              <div class="card shadow-sm text-center" >
                <div class="card-img-top p-3" style="background:#024089; height:95px;"><h4 class="card-title text-warning">Progress Report</h4></div>
                <div class="card-body mb-3 mt-1" style="height: 150px;">
                  
                  <p class="card-text">Every user of this app is capable of viewing the progress he or she has made as the course progresses !
                  </p>
                  
                </div>
              </div>
            </div>
            <!-- feature 4 -->
            <div class="col-lg-3 col-md-6 mt-4 px-4 py-5">
              <div class="card shadow-sm text-center" >
                <div class="card-img-top p-3" style="background:#024089; height:95px;"><h4 class="card-title text-warning">Ease of Scheduling</h4></div>
                <div class="card-body mb-3 mt-1" style="height: 150px;">
                  
                  <p class="card-text">Lessons and activities could easily be scheduled for a later date and whom ever is concerned will be notified !</p>
                  
                </div>
              </div>
            </div>
              
          
          
        </div>
          
      @endif
      
    </div>

  </div>

</div>


<!-- Check out our blog 
<div class="container-fluid p-0 my-5 pt-5">
  <div class="container  mt-5">
    <h2 class="text-center font-weight-bold" style="color: #024089;">Check out our Blog</h2>

  </div>
  <div class="container-fluid mb-5 custom-bg-2" >
    <div class="container">
      
      @if (true)
        <div class="row pb-4">
          @for ($i = 0; $i < 4; $i++)
            <div class="col-md-6 col-12 col-lg-3 mt-4 px-2 py-5">
              <div class="card shadow-lg text-center" >
                <img class="card-img-top" src="{{asset('img/team/team-2.jpg')}}" alt="Card image">
                <div class="card-body">
                  <h4 class="card-title">Blog 1</h4>
                  <p class="card-text">The ease of</p>
                  <a href="#" class="btn btn-warning">Read now</a>
                </div>
              </div>
            </div>
              
          @endfor
          
        </div>
          
      @endif
    </div>
  </div>-->

</div>

<!-- ======= Frequently Asked Questions Section ======= -->
<section id="faq" class="faq section-bg py-5">
  <div class="container">

    <div class="section-title">
      <h2>Frequently Asked Questions</h2>
    </div>

    <div class="row  d-flex align-items-stretch">

      <!-- Question 1 -->
          <div class="col-lg-6 faq-item" data-aos="fade-up">
            <h4>How can I create a Course?</h4>
            <p>Log in (if you're not signed up then click on the sign up button and sign up) , and then click on your Nameon the 
              top left corner, and then the dropdown  - and click on "Create Course" !
            </p>
          </div>
      <!-- Question 2 -->
          <div class="col-lg-6 faq-item" data-aos="fade-up">
            <h4>How can I Sign Up?</h4>
            <p>Click on sign up and fill in the details in the form shown !</p>
          </div>
      <!-- Question 3 -->
          <div class="col-lg-6 faq-item" data-aos="fade-up">
            <h4>What is the maximum file upload size?</h4>
            <p>The mamximum file upload size is 5kb.</p>
          </div>
      <!-- Question 4 -->
          <div class="col-lg-6 faq-item" data-aos="fade-up">
            <h4>How can I become a teacher?</h4>
            <p>When you create a course you automatically become the teacher of the course, and you're
              able to create and schedule lessons, and activities. As well as grade, you're activities.
            </p>
          </div>
      <!-- Question 5 -->
          <div class="col-lg-6 faq-item" data-aos="fade-up">
            <h4>How can I become a student?</h4>
            <p>Click on the course you want to enroll in and click on enroll, after entering the pasword(ask the teacher of the course for the password ) if any
              is required.
            </p>
          </div>
      <!-- Question 6 -->
          <div class="col-lg-6 faq-item" data-aos="fade-up">
            <h4>How can I stop taking a course?</h4>
            <p>Simply, navigate to the course and unenroll, however, please kindly leave a reason for unenrolling from the course.</p>
          </div>
     
              
      

    </div>

  </div>
</section><!-- End Frequently Asked Questions Section -->


<!--Contact Dev-->
<div class="container-fluid p-0" id="messages">
  <div class="row">
    <div class="col-md-7 py-5 px-5">
      <div class="card p-4 mt-5 shadow-lg ml-md-5 w-100" style="z-index: 12;">
        <div class="container">
          @include('inc.messages')
          <h3>Leave a Message for Developer</h3>
          <div style="background: #edcb23; height: 2px;" class="w-50"></div>
          <div class="container p-0 py-3" style="">
            <form action="{{route('developer.message')}}" method="post">
              <input type="hidden" name="type" value="greeting">
              <div class="form-group"><!--Use csrf - check wether this prevents bot submission-->
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" required>
                
                <div class="invalid-feedback">Please fill out your name.</div>
              </div>

              <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
                
                <div class="invalid-feedback">Please fill out correct email address.</div>
              </div>

              <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" class="form-control" id="phone" placeholder="Enter phone number" name="phone" required>
              
                <div class="invalid-feedback">Please fill out phone number.</div>
              </div>

              <div class="form-group">
                <label for="message">Message:</label>
                <textarea class="form-control" name="message" rows="3" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                <div class="validate"></div>
              </div>
              @csrf

              <div class="mx-auto">
                <button type="submit" class="btn btn-primary mt-1 float-right ">Send</button>

              </div>

            </form>
             
          </div>

        </div>
        
      </div>
    </div>
    <div class="col-md-5 dev-bg" style='background-image: url("{{asset('img/deco/dev-bg.jpg')}}");'></div>
  </div>
</div>



    
@endsection