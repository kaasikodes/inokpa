@extends('layouts.app')
@section('title')
  Section - {{$section->title}}

    
@endsection

@section('content')
@include('inc.messages')
    <!-- Extra Navigation--> 
    <div class="container mb-5">
      <small class="float-left text-warning"><a class="text-warning" href="{{route('activities.show',$section->activity->id)}}">{{$section->activity->title}} </a>> {{$section->title}} </small>
      <a href="{{url()->previous()}}" class="float-right">Go back</a>
      
    </div>

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
            <h5>No. of Questions - {{$section->questions ? $section->questions->count(): '0' }}</h5>
            <input type="hidden" id="section_id" value="{{$section->id}}">
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
            <!--add a question-->
            <div class="col-12">
              <div class="card shadow-sm p-2">

                <a href="" class="dropdown-item text-center text-primary" style="display: flex;" id="addQuestion"> 
                  <div style="border: 1px solid; border-radius:50%; width: 2rem; height: 2rem; display:flex; justify-content: center; align-items:center;">
                      <i class="fas fa-plus"></i>
                  </div>
                  <span class="pl-1" style="align-self: center;">Add question</span>
                </a>
                
              </div>
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
                    <script>
                      
                      function updateLinks() {
                        let linksBox = document.getElementById('links-box');
                        let sectionID = document.getElementById('section_id').value;
                        let xhr = new XMLHttpRequest();
                        xhr.open('GET',`/api/questions/${sectionID}/all`,true);
                        xhr.onload = function () {
                          //console.log(this.responseText)
                          let questions = JSON.parse(this.responseText).data;
                          linksBox.innerHTML = '';
                          for (let i = 0; i < questions.length; i++) {
                            linksBox.innerHTML += `
                            <a href="/api/questions/${questions[i].id}"class="mr-2 mb-2 p-2 badge badge-primary questionLink" style="width: 35px">
                              ${i + 1}
                            
                            </a>
                                
                            
                            `;
                            
                          }
                          console.log('Links updated');

                        
                          
                        };
                        xhr.send();
                        
                        
                      }
                    </script>
                  </div>
                  <div class="col-md-8">
                    <div class="card" >
                      <div class="card-body" >
                        @if ($section->category == 'MCQ')
                        <div id="hidden-box">
                          <form action="/api/questions/{{$section->id}}" method="post" id="questionForm">
                            <div class="form-group">
                              <label for="content"> Question</label>
                              <textarea type="text" name="content" id="content" rows="3" class="form-control" placeholder="What is your question ?"></textarea>
                            </div>
                            <div class="form-group">
                              <input type="text" name="option_a" id="option_a" placeholder="What is your option A?" class="form-control" >
                            </div>
                            <div class="form-group">
                              <input type="text" name="option_b" id="option_b" placeholder="What is your option B?" class="form-control">
                            </div>
                            <div class="form-group">
                              <input type="text" name="option_c" id="option_c" placeholder="What is your option C?" class="form-control">
                            </div>
                            <div class="form-group">
                              <input type="text" name="option_d" id="option_d" placeholder="What is your option D?" class="form-control">
                            </div>

                            <label>What is the correct answer to the question?</label>
                            <div class="form-inline">
                              
                              <div class="form-group mr-4">
                                <input type="radio" value="a" name="correct_answer" id="correct_answer_a" class="form-control"><label for="correct_answer">Option A</label>
                              </div>
                              <div class="form-group  mr-4">
                                <input type="radio" value="b" name="correct_answer" id="correct_answer_b" class="form-control"><label for="correct_answer">Option B</label>
                              </div>
                              <div class="form-group  mr-4">
                                <input type="radio" value="c" name="correct_answer" id="correct_answer_c" class="form-control"><label for="correct_answer">Option C</label>
                              </div>
                              <div class="form-group  mr-4">
                                <input type="radio" value="d" name="correct_answer" id="correct_answer_d" class="form-control"><label for="correct_answer">Option D</label>
                              </div>
                            </div>
                            <input type="hidden" name="id" id="id" value="">

                            

                            <button type="submit" class="btn btn-primary mt-3 float-md-right" id="save">Save</button>
                          
                          </form>
                        </div>
                        <div id="box">

                        </div>
                          <script>// adding questions
                            let addQuestionElement = document.getElementById('addQuestion');
                            let sectionID = document.getElementById('section_id').value;
                            let box =  document.getElementById('box');
                            addQuestionElement.addEventListener('click',addQuestion);
                            function addQuestion(e) {
                              e.preventDefault();
                              box.style.display = 'none';
                              
                              document.getElementById('hidden-box').style.display = 'block';
                              document.getElementById('questionForm').reset();
                              
                              
                            }
                            
                          
                          //saving quetions
                           let questionForm = document.getElementById('questionForm')
                           
                           questionForm.addEventListener('submit',saveQuestion)
                            function saveQuestion(e) {
                              e.preventDefault();
                              console.log(questionForm)
                              console.log(document.getElementById('id').value);
                              let data = '';
                              data+= 'content='+document.getElementById('content').value+'&'
                              +'option_a='+document.getElementById('option_a').value+'&'
                              +'option_b='+document.getElementById('option_b').value+'&'
                              +'option_c='+document.getElementById('option_c').value+'&'
                              +'option_d='+document.getElementById('option_d').value+'&'
                              +'id='+document.getElementById('id').value+'&';
                              if (document.getElementById('correct_answer_a').checked) {
                                
                                data+='correct_answer='+document.getElementById('correct_answer_a').value;
                              }
                              if (document.getElementById('correct_answer_b').checked) {
                                
                                data+='correct_answer='+document.getElementById('correct_answer_b').value;
                              }
                              if (document.getElementById('correct_answer_c').checked) {
                                
                                data+='correct_answer='+document.getElementById('correct_answer_c').value;
                              }
                              if (document.getElementById('correct_answer_d').checked) {
                                
                                data+='correct_answer='+document.getElementById('correct_answer_d').value;
                              }
                              let xhr =  new XMLHttpRequest();
                              xhr.open('POST',questionForm.action,true);
                              xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
                              xhr.onload = function() {
                                console.log(this.responseText);
                                let question = JSON.parse(this.responseText).data;
                                document.getElementById('hidden-box').style.display = 'none';
                                document.getElementById('box').style.display = 'block';
                                document.getElementById('box').innerHTML = `
                                  <div class = "container-fluid   py-2 px-0">
                                    <div class ="d-flex" >
                                      <a href="/api/questions/${question.id}" class = "btn btn-primary" id="questionEditLink" >Edit</a>
                                      <a href="/api/questions/${question.id}/delete" class = "btn btn-danger ml-auto" id="deleteQuestion" >Delete</a>
                                    </div>
                                    <hr>
                                    
                                  </div>


                                  <p>${question.content}</p>
                                  <div class="form-group ">
                                    A.) <input type="radio" value="a" name="option_a"  ><label class="pl-1">${question.option_a}</label>
                                    
                                  </div>
                                  <div class="form-group ">
                                    B.) <input type="radio" value="b" name="option_b"  ><label class="pl-1">${question.option_b}</label>
                                    
                                  </div>
                                  <div class="form-group ">
                                    C.) <input type="radio" value="b" name="option_c" ><label class="pl-1">${question.option_c}</label>
                                    
                                  </div>
                                  <div class="form-group ">
                                    D.) <input type="radio" value="b" name="option_d"  ><label class="pl-1">${question.option_d}</label>
                                    
                                  </div>

                                  <p class = "bg-success p-2"> The correct answer is option - ${question.correct_answer}</p>
                                  
                                
                                `;
                                document.getElementById('id').value = '';
                                updateLinks();
                                
                                
                                
                                
                              }

                              xhr.send(data);
                              

                              
                            }

                            // getting n showing single question
                            document.getElementById("links-box").addEventListener('click',showQuestion);
                            
                            function showQuestion(e) {
                              e.preventDefault();
                              if (e.target.tagName == 'A') {
                                console.log(e.target.getAttribute("href"));
                                
                                let url = e.target.getAttribute("href");
                                //make ajax call to handle showing question
                                let xhr = new XMLHttpRequest();
                                xhr.open('GET',url,true);
                                xhr.onload = function () {
                                  let question = JSON.parse(this.responseText).data;
                                  document.getElementById('hidden-box').style.display = 'none';
                                  document.getElementById('box').style.display = 'block';
                                  document.getElementById('box').innerHTML = `
                                  <div class = "container-fluid   py-2 px-0">
                                   <div class ="d-flex" >
                                    <a href="/api/questions/${question.id}" class = "btn btn-primary" id="questionEditLink" >Edit</a>
                                    <a href="/api/questions/${question.id}/delete" class = "btn btn-danger ml-auto  " id="deleteQuestion" >Delete</a>
                                    
                                   </div>
                                   <hr>
                                  
                                  </div>
                                  
                                
                                  <p>${e.target.textContent}.) ${question.content}</p>
                                  <div class="form-group ">
                                    A.) <input type="radio" value="a" name="option_a"  ><label class="pl-1">${question.option_a}</label>
                                    
                                  </div>
                                  <div class="form-group ">
                                    B.) <input type="radio" value="b" name="option_b"  ><label class="pl-1">${question.option_b}</label>
                                    
                                  </div>
                                  <div class="form-group ">
                                    C.) <input type="radio" value="c" name="option_c" ><label class="pl-1">${question.option_c}</label>
                                    
                                  </div>
                                  <div class="form-group ">
                                    D.) <input type="radio" value="d" name="option_d"  ><label class="pl-1">${question.option_d}</label>
                                    
                                  </div>

                                  <p class = "bg-success p-2"> The correct answer is option - ${question.correct_answer}</p>
                                  
                                
                                `;

                                
                                  
                                };
                                xhr.send();
                                
                              }
                              
                              
                            }




                            // getting n showing the edit form for a  single question
                            document.getElementById('box').addEventListener('click',editQuestion);
                            function editQuestion(e) {
                              e.preventDefault();
                              console.log(e.target)
                              if (e.target.id == 'questionEditLink') {
                                let url = e.target.getAttribute('href');
                                let xhr = new XMLHttpRequest();
                                xhr.open('GET',url,true);
                                xhr.onload = function () {
                                  let question = JSON.parse(this.responseText).data;
                                  document.getElementById('hidden-box').style.display = 'block';
                                  document.getElementById('box').style.display = 'none';
                                  // put the values in place
                                  document.getElementById('content').value = question.content;
                                  document.getElementById('option_a').value = question.option_a;
                                  document.getElementById('option_b').value = question.option_b;
                                  document.getElementById('option_c').value = question.option_c;
                                  document.getElementById('option_d').value = question.option_d;
                                  document.getElementById('id').value = question.id;
                                  if (question.correct_answer == 'a') {
                                    document.getElementById('correct_answer_a').checked = true ;
                                    
                                  }
                                  if (question.correct_answer == 'b') {
                                    document.getElementById('correct_answer_b').checked = true ;
                                    
                                  }
                                  if (question.correct_answer == 'c') {
                                    document.getElementById('correct_answer_c').checked = true ;
                                    
                                    
                                  }
                                  if (question.correct_answer == 'd') {
                                    document.getElementById('correct_answer_d').checked = true ;
                                    
                                    
                                  }

                                
                                  
                                };
                                xhr.send();
                                
                              
                                
                                
                              }
                              
                              
                            }
                            // delete the question
                            document.getElementById('box').addEventListener('click',deleteQuestion);
                            function deleteQuestion(e) {
                              e.preventDefault();
                              console.log('iworks');
                              if (e.target.id == 'deleteQuestion') {
                                
                                let url = e.target.getAttribute('href');
                                let xhr = new XMLHttpRequest();
                                xhr.open('GET',url,true);
                                xhr.onload = function () {
                                  document.getElementById('hidden-box').style.display = 'none';
                                  document.getElementById('box').style.display = 'block';
                                  document.getElementById('box').innerHTML = `
                                  <div class = "container-fluid   py-2">
                                    <p class = "">The question has been deleted !</p>
                                   
                                  
                                  </div>`;

                                  console.log('The question has been deleted');


                                  updateLinks();

                                
                                  
                                };
                                xhr.send();
                                
                              
                                
                              }
                              
                              
                              
                            }
                            
                            
                           
                          </script>
                            
                        @endif

                        @if ($section->category == 'Theory')
                        <div id="hidden-box">
                          <form action="/api/questions/{{$section->id}}" method="post" id="questionForm">
                            <div class="form-group">
                              <label for="content"> Question</label>
                              <textarea type="text" name="content" id="content" rows="3" class="form-control" placeholder="What is your question ?"></textarea>
                              
                            </div>
                            

                            <label>What is the mark assigned to this question?</label>
                            <div class="form-inline">
                              
                              <div class="form-group mr-4">
                                <input type="number" value="a" name="mark" id="mark" class="form-control"><label for="mark">points</label>
                              </div>
                              
                            </div>
                            <input type="hidden" name="id" id="id" value="">

                            

                            <button type="submit" class="btn btn-primary mt-3 float-md-right" id="save">Save</button>
                          
                          </form>
                        </div>
                        <div id="box">

                        </div>
                          <script>// adding questions
                            let addQuestionElement = document.getElementById('addQuestion');
                            let sectionID = document.getElementById('section_id').value;
                            let box =  document.getElementById('box');
                            addQuestionElement.addEventListener('click',addQuestion);
                            function addQuestion(e) {
                              e.preventDefault();
                              box.style.display = 'none';
                              
                              
                              
                              document.getElementById('hidden-box').style.display = 'block';
                              document.getElementById('questionForm').reset();
                              
                              
                            }
                            
                          
                          //saving quetions
                           let questionForm = document.getElementById('questionForm')
                           
                           questionForm.addEventListener('submit',saveQuestion)
                            function saveQuestion(e) {
                              e.preventDefault();
                              console.log(questionForm)
                              let data = '';
                              data+= 'content='+document.getElementById('content').value+'&'
                              +'mark='+document.getElementById('mark').value+'&'
                              +'id='+document.getElementById('id').value;
                              
                              let xhr =  new XMLHttpRequest();
                              xhr.open('POST',questionForm.action,true);
                              xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');
                              xhr.onload = function() {
                                
                                console.log(this.responseText)
                                let question = JSON.parse(this.responseText).data;
                                document.getElementById('hidden-box').style.display = 'none';
                                document.getElementById('box').style.display = 'block';
                                document.getElementById('box').innerHTML = `
                                  <div class = "container-fluid   py-2 px-0">
                                    <div class ="d-flex" >
                                      <a href="/api/questions/${question.id}" class = "btn btn-primary" id="questionEditLink" >Edit</a>
                                      <a href="/api/questions/${question.id}/delete" class = "btn btn-danger ml-auto" id="deleteQuestion" >Delete</a>
                                    </div>
                                    <hr>
                                    
                                  </div>


                                  
                                  <div class= "py-2">
                                    ${question.content}
                                  </div>
                                  

                                  <p class = "bg-success p-2"> This quesion carries - ${question.mark} points</p>
                                  
                                
                                `;
                                document.getElementById('id').value = '';

                                updateLinks();
                                
                                
                                
                                
                              }

                              xhr.send(data);
                              
                              
                            }

                            // getting n showing single question
                            document.getElementById("links-box").addEventListener('click',showQuestion);
                            
                            function showQuestion(e) {
                              e.preventDefault();
                              if (e.target.tagName == 'A') {
                                console.log(e.target.getAttribute("href"));
                                
                                let url = e.target.getAttribute("href");
                                //make ajax call to handle showing question
                                let xhr = new XMLHttpRequest();
                                xhr.open('GET',url,true);
                                xhr.onload = function () {
                                  let question = JSON.parse(this.responseText).data;
                                  document.getElementById('hidden-box').style.display = 'none';
                                  document.getElementById('box').style.display = 'block';
                                  document.getElementById('box').innerHTML = `
                                  <div class = "container-fluid   py-2 px-0">
                                   <div class ="d-flex" >
                                    <a href="/api/questions/${question.id}" class = "btn btn-primary" id="questionEditLink" >Edit</a>
                                    <a href="/api/questions/${question.id}/delete" class = "btn btn-danger ml-auto  " id="deleteQuestion" >Delete</a>
                                    
                                   </div>
                                   <hr>
                                  
                                  </div>
                                  
                                
                                  <p>${e.target.textContent}.) ${question.content}</p>
                                  

                                  <p class = "bg-success p-2"> This quesion carries - ${question.mark} points</p>
                                  
                                
                                `;

                                
                                  
                                };
                                xhr.send();
                                
                              }
                              
                              
                            }




                            // getting n showing the edit form for a  single question
                            document.getElementById('box').addEventListener('click',editQuestion);
                            function editQuestion(e) {
                              e.preventDefault();
                              console.log(e.target)
                              if (e.target.id == 'questionEditLink') {
                                let url = e.target.getAttribute('href');
                                let xhr = new XMLHttpRequest();
                                xhr.open('GET',url,true);
                                xhr.onload = function () {
                                  let question = JSON.parse(this.responseText).data;
                                  document.getElementById('hidden-box').style.display = 'block';
                                  document.getElementById('box').style.display = 'none';
                                  // put the values in place
                                  document.getElementById('content').value = question.content;
                                  document.getElementById('mark').value = question.mark;
                                  
                                  document.getElementById('id').value = question.id;
                                  

                                
                                  
                                };
                                xhr.send();
                                
                              
                                
                                
                              }
                              
                              
                            }
                            // delete the question
                            document.getElementById('box').addEventListener('click',deleteQuestion);
                            function deleteQuestion(e) {
                              e.preventDefault();
                              console.log('iworks');
                              if (e.target.id == 'deleteQuestion') {
                                
                                let url = e.target.getAttribute('href');
                                let xhr = new XMLHttpRequest();
                                xhr.open('GET',url,true);
                                xhr.onload = function () {
                                  document.getElementById('hidden-box').style.display = 'none';
                                  document.getElementById('box').style.display = 'block';
                                  document.getElementById('box').innerHTML = `
                                  <div class = "container-fluid   py-2">
                                    <p class = "">The question has been deleted !</p>
                                   
                                  
                                  </div>`;

                                  console.log('The question has been deleted');


                                  updateLinks();

                                
                                  
                                };
                                xhr.send();
                                
                              
                                
                              }
                              
                              
                              
                            }
                            
                            
                           
                          </script>
                            
                        @endif

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
    
