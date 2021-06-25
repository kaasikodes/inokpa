<div class="container-fluid" style="min-height: 100vh;   ">
   
  <div class="container">
    <div class="row" style=" height:100vh;">
      <div class="col-12 col-md-6 col-lg-5 pt-5">
         <h1 class="" style="font-weight: 900; line-height:90%; color:#024089; font-size:3rem;">Free Online <br> Learning</h1>
         <p class="pr-md-5 text-black-50 py-3">
           This is an online schooling platform designed to make learning as smooth and enjoyable  as possible.
           Learning is a 2-way street, on this platform you're both a teacher and a student. Learn something new everyday !
          </p>
         <div class="container-fluid p-0">
           <div class="d-flex flex-row justify-content-start" >
  
             
               <a href="{{route('courses.index')}}" class="btn btn-warning text-dark mr-3">Check out Courses</a>
            
  
             
               @guest
               <a href="{{route('register')}}" class="btn btn-success text-white">Sign Up</a>
               @endguest
               
            
           </div>
  
           
         </div>
        
      </div>
      <div class="col-12 col-md-6 col-lg-7" >
        <div class="container">
         <div>
           <img src="{{asset('img/deco/school.png')}}" alt="" class="" style="width: 100%; ">
         </div>
         
         
       </div>
      
      </div>
    </div>
  </div>
</div>

