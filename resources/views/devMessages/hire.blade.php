@extends('layouts.app')

@section('title')
    Hire Developer
@endsection

@section('content')

  <div class="container my-5 py-2">
      <!--heading -->
      <h1 class="title font-weight-bold" style="color: #024089">Hire Developer</h1>
      <div style="background: #edcb23; height: 2px; width:90px;" class="ml-2"></div>

     
      <!-- Write a message  -->
      <div class="container-fluid">
        
        <div class="card p-4 mt-5 shadow-lg  w-100" style="z-index: 12;">
          @include('inc.messages')
            <div class="container">
             
              <h3>Let's discuss your project!</h3>
              <div style="background: #edcb23; height: 2px;" class="w-50"></div>
              <div class="container p-0 py-3" style=""> 
                <form action="{{route('developer.message')}}" method="post">
                  <!-- contact details -->
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
                  <!-- project details -->
                  <div style="height: 2px;" class="w-100 my-4 bg-primary"></div>

                  <div class="form-group">
                    <label for="project_title">Project Title:</label>
                    <input type="text" class="form-control" id="project_title" placeholder="What is the title of your project?" name="project_title" required>
                  
                    <div class="invalid-feedback">Please fill out project title.</div>
                  </div>

                  <div class="form-inline mt-4 mb-4">
                    <div class="form-group">
                        {{Form::label('budget', 'Budget (in dollars)')}}
                        
                        <input type="number" min=0 name="budget" id="" value="" class="ml-2 form-control">
    
                        
                        
                    </div>
    
                </div>
    
    
                  <div class="form-group">
                    <label for="message">Description:</label>
                    <textarea class="form-control" name="message" rows="3" data-rule="required" data-msg="Please write something for us" placeholder="Description of your project"></textarea>
                    <div class="validate"></div>
                  </div>

                  <input type="hidden" name="type" value="job">

                  
                  @csrf
                  <div style="height: 2px;" class="w-100 my-4 bg-primary"></div>
    
                  <div class="mx-auto">
                    <button type="submit" class="btn btn-primary mt-1 float-right ">Send</button>
    
                  </div>
    
                </form>
                 
              </div>
    
            </div>
            
          </div>
      </div>
      
      
  </div>
    
@endsection