@extends('layouts.app')
@section('title')
  Section - {{$section->title}} 
@endsection

@section('content')
 <!-- this is used for both editing and creating answers -->
    

    <!-- Extra Navigation--> 
    <div class="container mb-5">
      <small class="float-left text-warning"><a class="text-warning" href="{{route('activities.show',$section->activity->id)}}">{{$section->activity->title}} </a>> {{$section->title}} </small>
      <a href="{{url()->previous()}}" class="float-right">Go back</a>
      
    </div>
    @include('inc.messages')


  <!-- Main Section -->
  <div class="container py-4">
    <!-- heading -->
    <div class="container mb-4 text-center">

      <h1 class="text-center font-weight-bold">{{$section->activity->course->title}} - {{$section->activity->title}}</h1>
      <div style="background: #edcb23; height: 2px;" class="w-50 mx-auto"></div>
      <small class="text-center text-muted">Author - {{$section->activity->course->users->first()->name}} | belongs to {{$section->activity->course->title}}</small>

    </div>
    <!-- content -->
    <div class="row">
      <!-- section details -->
      <div class="col-12">
        @if (Auth::user()->courses->where('id',$section->activity->course->id)->first())<!-- autorization -->
          @if (Auth::user()->courses->where('id',$section->activity->course->id)->first()->pivot->role == 'teacher')
              <div class="container  py-5 px-0"><!-- edit and delete -->

                <a href="{{route('sections.edit',$section->id)}}" class="btn btn-success float-left">Edit</a>

                {!!Form::open(['action' => ['SectionsController@destroy',$section->id],'class'=> 'float-right'])!!}
                {{Form::hidden('_method','DELETE')}}
                @csrf
            
                {{Form::submit('Delete', ['class'=>' btn btn-danger'])}}
                {!!Form::close()!!}
              </div>
         @endif
        @endif


        <div class="container mt-3 p-4 d-flex justify-content-md-between"  style="background: #024089; height:200px">
          <div class="text-white-50">
            <h4 class="text-white">Section Title - {{$section->title}}</h4>
            <h5>Category - {{$section->category}}</h5>
            <h5>Time Duration - {{$actual_time}} (hrs and mins)</h5>
            <h5>Contribution to Activity - {{$section->contribution_to_activity}}%</h5>
            <h5>No. of Questions - {{$section->questions ? $section->questions->count(): '0' }} </h5>
            <br>
            
            <input type="hidden" id="section_id" value="{{$section->id}}">
            <input type="hidden" id="section_duration" value="{{$sectionTime->time_left}}">
            <input type="hidden" id="section_time_id" value="{{$sectionTime->id}}">
            
            
            <input type="hidden" id="user_id" value="{{Auth::user()->id}}">
          </div>

        </div>
        <div class="card mx-auto text-center py-1 px-2 w-75 shadow-sm" style="margin-top: -10px">
          <h4 class="">Instructions</h4>
          <hr>
          {!!$section->instruction!!}
        </div>
      </div>
      <!--questions -->
      <div class="col-12 my-5 py-2">
        <div class="container-fluid my-3 p-0">
          <div class="row">
            <!-- timersection -->
            <div class="col-12 mt-3 p-2">
              Time Left:
                  <p id="timer">
                      <span id="timer-days"></span>
                      <span id="timer-hours"></span>
                      <span id="timer-mins"></span>
                      <span id="timer-secs"></span>
                  </p>
            </div>
            
            <!-- questions section -->
            <div class="col-12 mt-3">
              <div class="container-fluid p-0">
                <div class="row">
                  <div class="col-md-4 ">
                    <div class="d-flex flex-row flex-wrap p-3  pl-4 card shadow-sm text-white" id="links-box">
                      
                      @for ($i = 0; $i < $section->questions->count(); $i++)
                        <a href="/api/questions/{{$section->questions[$i]->id}}"class="mr-2 mb-2 p-2 badge badge-primary questionLink" style="width: 35px">
                          {{$i + 1}}
                        
                        </a>
                        
                          
                      @endfor

                    </div>
                    
                  </div>
                  <div class="col-md-8">
                    <div class="card" >
                      <div class="card-body" >
                        @if ($section->category == 'MCQ')
                        <div id="hidden-box">
                          <form action="/api/answers/{{$section->id}}" method="post" id="answerForm">
                            <div class="form-group">
                              <label><span id="number">1.) </span> <span id="content"></span> </label>
                              
                            </div>

                            <div class="form-group ">
                                A.) <input type="radio" value="a" name="content"  id="option_a"><label class="pl-1" id="label_option_a"></label>
                                
                              </div>
                              <div class="form-group ">
                                B.) <input type="radio" value="b" name="content"  id="option_b"><label class="pl-1" id="label_option_b"></label>
                                
                              </div>
                              <div class="form-group ">
                                C.) <input type="radio" value="c" name="content" id="option_c"><label class="pl-1" id="label_option_c"></label>
                                
                              </div>
                              <div class="form-group ">
                                D.) <input type="radio" value="d" name="content"  id="option_d"><label class="pl-1" id="label_option_d"></label>
                                
                            </div>
                            <input type="hidden" name="id" id="id" value="">
                            <input type="hidden" name="question_id" id="question_id" value="">
                            

                            

                            
                          
                          </form>
                          
                        </div>
                        <div id="box">

                        </div>
                          <script>
                            
                          
                          //saving answers
                           let answerForm = document.getElementById('answerForm')
                           
                           answerForm.addEventListener('input',saveAnswer)
                            function saveAnswer(e) {
                              e.preventDefault();
                            
                              let data = '';
                              data+='section_id='+document.getElementById('section_id').value+'&'
                              +'question_id='+document.getElementById('question_id').value+'&'
                              +'user_id='+document.getElementById('user_id').value+'&'
                              +'id='+document.getElementById('id').value+'&';
                              if (document.getElementById('option_a').checked) {
                                
                                data+='content='+document.getElementById('option_a').value;
                              }
                              if (document.getElementById('option_b').checked) {
                                
                                data+='content='+document.getElementById('option_b').value;
                              }
                              if (document.getElementById('option_c').checked) {
                                
                                data+='content='+document.getElementById('option_c').value;
                              }
                              if (document.getElementById('option_d').checked) {
                                
                                data+='content='+document.getElementById('option_d').value;
                              }
                              let xhr =  new XMLHttpRequest();
                              xhr.open('POST',answerForm.action,true);
                              xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
                              xhr.onload = function() {
                             
                                let answer = JSON.parse(this.responseText).data;
                                let question = JSON.parse(this.responseText).question;

                                document.getElementById('content').textContent = question.content ;
                                document.getElementById('question_id').value = question.id;
                                //document.getElementById('section_id').value = answer.section_id;
                                document.getElementById('id').value = answer.id;
                                if (answer.content == 'a') {
                                    document.getElementById('option_a').checked = true;
                                    
                                }
                                if (answer.content == 'b') {
                                    document.getElementById('option_b').checked = true;
                                    
                                }
                                if (answer.content == 'c') {
                                    document.getElementById('option_c').checked = true;
                                    
                                }
                                if (answer.content == 'd') {
                                    document.getElementById('option_d').checked = true;
                                    
                                }
                                
                                
                                
                                
                                
                                
                              }

                              xhr.send(data);
                              

                              
                            }
                            //function to chck for wether question has answer
                            function checkForAnswerAndUpdate(question_id,user_id) {

                                url = `/api/answers/${user_id}/${question_id}/check`;
                                
                                let xhr = new XMLHttpRequest();
                                xhr.open('GET',url,true);
                                xhr.onload = function () {
                                  
                                
                                  if (this.responseText == false) {
                                    
                                  
                                    document.getElementById('id').value = '';
                                    
                                  }else{
                                    //let answer = JSON.parse(this.responseText).data;
                                  
                                    let answer =  JSON.parse(this.responseText)
                                    document.getElementById('id').value = answer.id;
                                    if (answer.content == 'a') {
                                        document.getElementById('option_a').checked = true;
                                        
                                    }
                                    if (answer.content == 'b') {
                                        document.getElementById('option_b').checked = true;
                                        
                                    }
                                    if (answer.content == 'c') {
                                        document.getElementById('option_c').checked = true;
                                        
                                    }
                                    if (answer.content == 'd') {
                                        document.getElementById('option_d').checked = true;
                                        
                                    }
                                   
                                    
                                  }
                                  

                                  
                                };
                                xhr.send();
                                

                            }
                           
                            document.addEventListener('DOMContentLoaded',function () {
                                let ql = document.getElementsByClassName("questionLink")[0];
                              
                                let url = ql.getAttribute("href");
                               
                                //make ajax call to handle showing question
                                let xhr = new XMLHttpRequest();
                                xhr.open('GET',url,true);
                                xhr.onload = function () {
                                document.getElementById("box").style.display = 'none';
                                document.getElementById("hidden-box").style.display = 'block';

                                  let question = JSON.parse(this.responseText).data;
                                
                                  document.getElementById('number').textContent = ql.textContent +".)";
                                  document.getElementById('content').textContent = question.content;
                                  document.getElementById('question_id').value = question.id;
                                  //document.getElementById('section_id').value = answer.section_id;
                                  //document.getElementById('id').value = answer.id;

                                  // first of all reset it
                                  document.getElementById('answerForm').reset();

                                  //set the options for question
                                  document.getElementById('label_option_a').textContent = question.option_a;
                                  document.getElementById('label_option_b').textContent = question.option_b;
                                  document.getElementById('label_option_c').textContent = question.option_c;
                                  document.getElementById('label_option_d').textContent = question.option_d;

                                  // if there is an answer show the answer
                                  let question_id = question.id;
                                  let user_id = document.getElementById('user_id').value;
                                 
                                  checkForAnswerAndUpdate(question_id,user_id);
                                  
                                  

                                
                                  
                                };
                                xhr.send();
                              
                            });

                            // getting n showing single question
                            document.getElementById("links-box").addEventListener('click',showQuestion);
                            
                            function showQuestion(e) {
                              e.preventDefault();
                              if (e.target.tagName == 'A') {
                            
                                
                                let url = e.target.getAttribute("href");
                                //make ajax call to handle showing question
                                let xhr = new XMLHttpRequest();
                                xhr.open('GET',url,true);
                                xhr.onload = function () {
                                document.getElementById("box").style.display = 'none';
                                document.getElementById("hidden-box").style.display = 'block';

                                  let question = JSON.parse(this.responseText).data;
                                  
                                  
                                  
                                  document.getElementById('number').textContent = e.target.textContent +".)";
                                  document.getElementById('content').textContent = question.content;
                                  document.getElementById('question_id').value = question.id;
                                  //document.getElementById('section_id').value = answer.section_id;
                                  //document.getElementById('id').value = answer.id;

                                  // first of all reset it
                                  document.getElementById('answerForm').reset();

                                  //set the options for question
                                  document.getElementById('label_option_a').textContent = question.option_a;
                                  document.getElementById('label_option_b').textContent = question.option_b;
                                  document.getElementById('label_option_c').textContent = question.option_c;
                                  document.getElementById('label_option_d').textContent = question.option_d;

                                  // if there is an answer show the answer
                                  let question_id = question.id;
                                  let user_id = document.getElementById('user_id').value;
                                  
                                  checkForAnswerAndUpdate(question_id,user_id);
                                  
                                  

                                
                                  
                                };
                                xhr.send();
                                
                              }
                              
                              
                            }


                          </script>
                            
                        @endif

                        @if ($section->category == 'Theory')
                        <div id="hidden-box">
                          <form action="/api/answers/{{$section->id}}" method="post" id="answerForm">
                            <div class="form-group">
                              <label><span id="number">1.) </span> <span id="content">{{$section->questions->first()->content}}</span> <br>
                                <span id="marks">({{$section->questions->first()->mark}} marks)</span>
                              
                              </label>
                              
                            </div>

                            <div class="form-group ">
                                <textarea name="" id="answer_content"  rows="3" placeholder="Type your answer here" class="form-control"></textarea>
                                <script>
                                    // Replace the <textarea id="editor1"> with a CKEditor 4
                                    // instance, using default configuration.
                                    //CKEDITOR.replace( 'answer_content' );
                                </script>
                                
                            </div>
                              
                            <input type="hidden" name="id" id="id" value="">
                            <input type="hidden" name="question_id" id="question_id" value="{{$section->questions->first()->id}}">
                            

                            

                            
                          
                          </form>
                        </div>
                        <div id="box">

                        </div>
                          <script>
                            
                          
                          //saving answers
                          document.addEventListener('DOMContentLoaded', function () {
                            let ql = document.getElementsByClassName("questionLink")[0];
                              
                            let url = ql.getAttribute("href");
                            //make ajax call to handle showing question
                            let xhr = new XMLHttpRequest();
                            xhr.open('GET',url,true);
                            xhr.onload = function () {
                              document.getElementById("box").style.display = 'none';
                            document.getElementById("hidden-box").style.display = 'block';
                              let question = JSON.parse(this.responseText).data;
                              
                              
                              
                              document.getElementById('number').textContent = ql.textContent +".)";
                              document.getElementById('content').textContent = question.content;
                              document.getElementById('marks').textContent = `(${question.mark} marks)`;
                              document.getElementById('question_id').value = question.id;
                              //document.getElementById('section_id').value = answer.section_id;
                              //document.getElementById('id').value = answer.id;

                              // first of all reset it
                              document.getElementById('answerForm').reset();

                              

                              // if there is an answer show the answer
                              let question_id = question.id;
                              let user_id = document.getElementById('user_id').value;
                        
                              checkForAnswerAndUpdate(question_id,user_id); // this updattes the fields on the form not in DB table
                              
                              

                            
                              
                            };
                            xhr.send();
                                
                            setInterval(function () {
                              saveAnswer();
                              
                            },20000);
                            
                          });
                           
                           
                           
                            function saveAnswer() {
                              let answerForm = document.getElementById('answerForm')
                              
                              
                             
                              let data = '';
                              data+='section_id='+document.getElementById('section_id').value+'&'
                              +'question_id='+document.getElementById('question_id').value+'&'
                              +'user_id='+document.getElementById('user_id').value+'&'
                              +'id='+document.getElementById('id').value+'&';
                              data+='content='+document.getElementById('answer_content').value;
                              
                              let xhr =  new XMLHttpRequest();
                              xhr.open('POST',answerForm.action,true);
                              xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
                              xhr.onload = function() {
                             
                                let answer = JSON.parse(this.responseText).data;
                                let question = JSON.parse(this.responseText).question;

                                document.getElementById('content').textContent = question.content;
                                document.getElementById('question_id').value = question.id;
                                //document.getElementById('section_id').value = answer.section_id;
                                document.getElementById('id').value = answer.id;
                                //document.getElementById('answer_content').value = answer.content;
                                
                                
                                
                                
                                
                                
                                
                              }

                              xhr.send(data);
                              

                              
                            }
                            //function to chck for wether question has answer
                            function checkForAnswerAndUpdate(question_id,user_id) {

                                url = `/api/answers/${user_id}/${question_id}/check`;
                                
                                let xhr = new XMLHttpRequest();
                                xhr.open('GET',url,true);
                                xhr.onload = function () {
                                  
                                 
                           
                                  if (this.responseText == false) {
                                    
                                  
                                    document.getElementById('id').value = '';
                                    
                                  }else{
                                    //let answer = JSON.parse(this.responseText).data;
                                
                                    let answer =  JSON.parse(this.responseText)
                                    document.getElementById('id').value = answer.id;
                                    document.getElementById('answer_content').value = answer.content;
                                   
                                    
                                  }
                                  

                                  
                                };
                                xhr.send();
                                

                            }

                            // getting n showing single question
                            document.getElementById("links-box").addEventListener('click',showQuestion);
                            
                            function showQuestion(e) {
                              e.preventDefault();
                              if (e.target.tagName == 'A') {
                                
                                
                                let url = e.target.getAttribute("href");
                                //make ajax call to handle showing question
                                let xhr = new XMLHttpRequest();
                                xhr.open('GET',url,true);
                                xhr.onload = function () {
                                  document.getElementById("box").style.display = 'none';
                                document.getElementById("hidden-box").style.display = 'block';
                                  let question = JSON.parse(this.responseText).data;
                                  
                             
                                  
                                  document.getElementById('number').textContent = e.target.textContent +".)";
                                  document.getElementById('content').textContent = question.content;
                                  document.getElementById('marks').textContent = `(${question.mark} marks)`;
                                  document.getElementById('question_id').value = question.id;
                                  //document.getElementById('section_id').value = answer.section_id;
                                  //document.getElementById('id').value = answer.id;

                                  // first of all reset it
                                  document.getElementById('answerForm').reset();

                                  

                                  // if there is an answer show the answer
                                  let question_id = question.id;
                                  let user_id = document.getElementById('user_id').value;
                               
                                  checkForAnswerAndUpdate(question_id,user_id); // this updattes the fields on the form not in DB table
                                  
                                  

                                
                                  
                                };
                                xhr.send();
                                
                              }
                              
                              
                            }


                          </script>
                            
                        @endif
                      </div>
                      <script>
                        // this section is responsible for the forced sumbission and coutdown for answering questions - 
                        //consider using this section to periodically save answer rather than at each input - 
                        //this will probably reduce the amount of requests - 
                        //although it wont be central again and will have to be split for both sections i.e thry/mcq

                        
                        const duration = document.getElementById('section_duration').value;
                        let t = duration;
                        var timer =  setInterval(function() {
                               
                               if (t > 0) {
                                t -= 1000;
                                let days = Math.floor(t / (1000 * 60 * 60 * 24));
                                let hours = Math.floor((t % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                let mins = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60));
                                let secs = Math.floor((t % (1000 * 60)) / 1000);

                                document.getElementById("timer-days").innerHTML = days +
                                "<span class='label'>DAY(S)</span>";

                                document.getElementById("timer-hours").innerHTML = ("0"+hours).slice(-2) +
                                "<span class='label'>HR(S)</span>";

                                document.getElementById("timer-mins").innerHTML = ("0"+mins).slice(-2) +
                                "<span class='label'>MIN(S)</span>";

                                document.getElementById("timer-secs").innerHTML = ("0"+secs).slice(-2) +
                                "<span class='label'>SEC(S)</span>";

                                // update in database
                                let sectionTimeID = document.getElementById("section_time_id").value
                                let xhr = new XMLHttpRequest();
                                xhr.open('GET',`/api/sectiontimes/${sectionTimeID}/${t}`,true);
                                xhr.onload = function () {
                          
                                  
                                };
                                xhr.send();
                                console.log(t);
                                 
                               } else {


                                clearInterval(timer);
                                document.getElementById("timer").innerHTML = "The countdown is over!";
                                document.getElementById("hidden-box").style.display = 'none';
                                document.getElementById("box").style.display = 'block';

                                document.getElementById("box").innerHTML = `

                                  <p class = "py-2"> Your time is expired and your answers have been saved. Head back
                                  and proceed to any uncompleted section in this activity</p>
                                .`;
                                
                                document.getElementById('option_a').disabled = true;
                                document.getElementById('option_b').disabled = true;
                                document.getElementById('option_c').disabled = true;
                                document.getElementById('option_d').disabled = true;

                                 
                                 
                               }
                               

                               
                               

                           
                           }, 1000);
                           timer();
                           if (t <= 0) {
                            document.getElementById('answer_content').disabled = true;
                            document.getElementById('option_a').disabled = true;
                                document.getElementById('option_b').disabled = true;
                                document.getElementById('option_c').disabled = true;
                                document.getElementById('option_d').disabled = true;


                            
                             
                           }
                            
                            
                            
                                                        
                              
                            
                          



                        
                       
                       

                      

                      </script>

                    </div>

                    <div class="container-fluid mt-3 px-0" >
                      <div class="row">
                        <div class="col-lg-6 order-lg-0 order-2"></div>
                        <div class="col-lg-6 order-lg-1 order-1 d-flex justify-content-lg-end justify-content-start">
                          <button  type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">All done, Save Answers</button>
                          <!-- The Modal -->
                          <div class="modal" id="myModal">
                            <div class="modal-dialog">
                              <div class="modal-content text-center">

                                <!-- Modal Header -->
                                <div class="modal-header bg-blue">
                                  <h4 class="modal-title text-warning text-center">Confirmation</h4>
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                  Are you sure you're done ?
                                  <div class="container d-flex mt-3 justify-content-center">
                                    <a href="{{route('submissions.log_section',[$section->id,Auth::user()->id])}}" class="btn btn-success">Yes</a>
                                    <button type="button" class="btn btn-danger ml-lg-2" data-dismiss="modal">No</button>
                                  </div>
                                </div>

                                

                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

  </div>

    
@endsection