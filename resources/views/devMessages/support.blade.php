@extends('layouts.app')

@section('title')
    Support
@endsection

@section('content')

  <div class="container my-5 py-2">
      <!--heading -->
      <h1 class="title font-weight-bold" style="color: #024089">How can we assist you?</h1>
      <div style="background: #edcb23; height: 2px; width:90px;" class="ml-2"></div>

     
      <!-- Write a message  -->
      <div class="container-fluid">
       
        <div class="card p-4 mt-5  w-100" style="z-index: 12;">
            @include('inc.messages')
            <div class="container">
             
              <h3>What is the problem?</h3>
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
                  
    
                  <div class="form-group">
                    <label for="message">Describe the problem your encontering?</label>
                    <textarea class="form-control" name="message" rows="3" data-rule="required" data-msg="Please write something for us" placeholder="Describe the issue your facing?"></textarea>
                    <div class="validate"></div>
                  </div>

                  <input type="hidden" name="type" value="support">

                  
                  @csrf
    
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