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


        <div class="container mt-3 p-4 d-flex justify-content-md-between"  style="background: #024089;  ">
          <div class="text-white-50">
            <h4 class="text-white">{{$student->name}}</h4>
            <h5>{{$section->title}} ({{$section->category}})</h5>
            <h5>Time Spent on Section - {{$time_spent}} (hrs and mins)</h5>
            <h5>Contribution to Activity - {{$section->contribution_to_activity}}%</h5>
            <h5>No. of Questions Answered - {{$student->answers->where('section_id',$section->id)->count()}} out of {{$section->questions ? $section->questions->count(): '0' }} </h5>
            <br>
            
            <input type="hidden" id="section_id" value="{{$section->id}}">
          
            
            <script>
              console.log(document.getElementById('section_id').value);
            </script>
            <input type="hidden" id="user_id" value="{{Auth::user()->id}}">
          </div>

          <div class="text-right">
            <h2 class=" bg-secondary text-white-50 px-3 py-2">{{$section->activity->course->title}}</h2>
          </div>

        </div>
        
      </div>
      <!--questions -->
      <div class="col-12 my-5 py-2">
        <div class="container-fluid my-3 p-0">
          <div class="row">
            
            <!-- questions section -->
            <div class="col-12 mt-3">
              <div class="container-fluid p-0">
                <div class="row">
                  <div class="col-md-4 ">
                    <div class="d-flex flex-row flex-wrap p-3  pl-4 card shadow-sm text-white" id="links-box">
                      <?php $i = 1;  ?>
                      @foreach ($answers as $answer)
                      <a href="/api/assessments/{{$answer->id}}/show"class="mr-2 mb-2 p-2 badge badge-primary questionLink" style="width: 35px">
                        {{$i}}
                        
                      
                      </a>
                        <?php $i++; ?>
                      @endforeach

                    </div>
                    
                  </div>
                  <div class="col-md-8">
                    <div class="card">
                      <div class="card-body">
                        @if ($section->category == 'Theory')
                        <div id="hidden-box">
                          <form action="/api/answers/{{$section->id}}" method="post" id="assessmentForm">
                            <div class="form-group">
                              <label><span id="number">1.) </span> <span id="question_content">{{$answers->first()->question->content}}</span> <br>
                                
                                <div class="form-inline">
                                  <div class="form-group">
                                    <input type="number" name="score" id="score" class="form-control" max="{{$answers->first()->question->mark}}" value="{{$answers->first()->score}}">
                                    <label for="" > out of <span id="marks">{{$answers->first()->question->mark}}</span>  marks</label>
                                  </div>
                                </div>
                              
                              </label>
                              
                            </div>

                            <div class="form-group ">
                                <textarea name="" id="answer_content"  rows="3" placeholder="Type your answer here" class="form-control" disabled>{{$answers->first()->content}}</textarea>
                                <script>
                                    // Replace the <textarea id="editor1"> with a CKEditor 4
                                    // instance, using default configuration.
                                    //CKEDITOR.replace( 'answer_content' );
                                </script>
                                
                            </div>
                              
                            <input type="hidden" name="id" id="id" value="">
                           
                            

                            

                            
                          
                          </form>
                        </div>
                        <div id="box">

                        </div>

                        <script>
                          //show answer
                          document.getElementById('links-box').addEventListener('click',showAnswer);
                          
                          function showAnswer(e) {
                            
                            if (e.target.tagName == 'A') {
                              e.preventDefault();
                              let url = e.target.getAttribute("href");
                              console.log(url)
                              let xhr = new XMLHttpRequest();
                                xhr.open('GET',url,true);
                                xhr.onload = function () {
                                  
                                  console.log('the response is')
                                  //console.log(this.responseText)
                                  let answer = JSON.parse(this.responseText).data;
                                  console.log(answer)
                                  let question = JSON.parse(this.responseText).question;
                                  console.log(question)
                                  document.getElementById('id').value = answer.id;
                                  document.getElementById('score').value = answer.score;
                                  document.getElementById('score').setAttribute('max',question.mark);
                                  document.getElementById('answer_content').value = answer.content;
                                  document.getElementById('question_content').textContent = question.content;
                                  document.getElementById('marks').textContent = question.mark;
                                  document.getElementById('number').textContent = e.target.textContent + ".)";

                                  
                                };
                                xhr.send();
                              
                            }
                                
                                
                                
                            
                          }

                          //save answer
                          document.addEventListener('input',saveScore);
                          function saveScore() {
                              let id = document.getElementById('id').value;
                              let data = '';
                              data+='score='+document.getElementById('score').value;

                              let url = `/api/assessments/${id}/save`;
                              
                              let xhr =  new XMLHttpRequest();
                              xhr.open('POST',url,true);
                              xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
                              xhr.onload = function() {
                                
                                console.log('the response is now')
                                  //console.log(this.responseText)
                                  let answer = JSON.parse(this.responseText).data;
                                  console.log(answer)
                                  let question = JSON.parse(this.responseText).question;
                                  console.log(question)
                                  document.getElementById('id').value = answer.id;
                                  document.getElementById('score').value = answer.score;
                                  document.getElementById('answer_content').value = answer.content;
                                  document.getElementById('question_content').textContent = question.content;
                                  document.getElementById('marks').textContent = question.mark;
                                  
                                
                                
                                
                                
                                
                                
                                
                                
                              }

                              xhr.send(data);
                            
                          }
                        </script>
                            
                        @endif





                        @if ($section->category == 'MCQ')
                        <div id="hidden-box">
                          <form action="/api/answers/{{$section->id}}" method="post" id="assessmentForm">
                            <div class="form-group">
                              <label><span id="number">1.) </span> <span id="question_content">{{$answers->first()->question->content}}</span> <br>
                                
                                <div class="form-inline">
                                  <div class="form-group">
                                    
                                    
                                    <label for="" ><span  id="score"> </span> / <span id="marks">{{$answers->first()->question->mark}}</span>  mark(s)</label>
                                  </div>
                                </div>
                              
                              </label>
                              
                            </div>

                            <div class="form-group ">
                              
                              A.) <input type="radio" value="a" name="content"  id="option_a"  {{$answers->first()->content == 'a' ? 'checked' : ''}} disabled><label class="pl-1" id="label_option_a">{{$answers->first()->question->option_a}}</label>
                              
                            </div>
                            <div class="form-group ">
                              B.) <input type="radio" value="b" name="content"  id="option_b" {{$answers->first()->content == 'b' ? 'checked' : ''}} disabled><label class="pl-1" id="label_option_b">{{$answers->first()->question->option_b}}</label>
                              
                            </div>
                            <div class="form-group ">
                              C.) <input type="radio" value="c" name="content" id="option_c" {{$answers->first()->content == 'c' ? 'checked' : ''}} disabled><label class="pl-1" id="label_option_c">{{$answers->first()->question->option_c}}</label>
                              
                            </div>
                            <div class="form-group ">
                              D.) <input type="radio" value="d" name="content"  id="option_d" {{$answers->first()->content == 'd' ? 'checked' : ''}} disabled><label class="pl-1" id="label_option_d">{{$answers->first()->question->option_d}}</label>
                              
                          </div>
                              
                            <input type="hidden" name="id" id="id" value="">
                           
                            

                            

                            
                          
                          </form>
                        </div>
                        <div id="box" class="bg-success text-white p-2">
                          <p>The correct answer is - "{{$answers->first()->question->correct_answer}}"</p>

                        </div>

                        <script>
                          //show answer
                          document.getElementById('links-box').addEventListener('click',showAnswer);
                          function showAnswer(e) {
                            
                            if (e.target.tagName == 'A') {
                              e.preventDefault();
                              let url = e.target.getAttribute("href");
                              console.log(url)
                              let xhr = new XMLHttpRequest();
                                xhr.open('GET',url,true);
                                xhr.onload = function () {
                                  
                                  console.log('the response is')
                                  //console.log(this.responseText)
                                  let answer = JSON.parse(this.responseText).data;
                                  console.log(answer)
                                  let question = JSON.parse(this.responseText).question;
                                  console.log(question)
                                  document.getElementById('id').value = answer.id;
                                  document.getElementById('score').textContent = answer.score;
                                  
                                  document.getElementById('label_option_a').textContent = question.option_a;
                                  document.getElementById('label_option_b').textContent = question.option_b;
                                  document.getElementById('label_option_c').textContent = question.option_c;
                                  document.getElementById('label_option_d').textContent = question.option_d;
                                  document.getElementById('question_content').textContent = question.content;
                                  document.getElementById('marks').textContent = question.mark;
                                  document.getElementById('number').textContent = e.target.textContent + ".)";


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
                                  document.getElementById('box').innerHTML = `<p>The correct answer is - "${question.correct_answer}"</p>`

                                  
                                };
                                xhr.send();

                                
                              
                            }
                                
                                
                                
                            
                          }

                          
                        </script>
                            
                        @endif
                      </div>
                      
                      

                    </div>
                    <div class="container-fluid mt-3 px-0" >
                      <div class="row">
                        <div class="col-lg-6 order-lg-0 order-2"></div>
                        <div class="col-lg-6 order-lg-1 order-1 d-flex justify-content-lg-end justify-content-start">
                          <button  type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">All done, Save Grading</button>
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
                                  Are you sure you're done grading ?
                                  <div class="container d-flex mt-3 justify-content-center">
                                    <a href="{{route('assessments.log_section',[$section->id,$student->id])}}" class="btn btn-success">Yes</a>
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