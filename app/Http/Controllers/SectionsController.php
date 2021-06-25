<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Section;
use App\Activity;
use App\Question;
use App\Http\Requests;
use App\Http\Resources\Question as QuestionResource;

class SectionsController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Activity $activity)
    {
        return view('sections.create', compact('activity'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Activity $activity)
    {
        
        $data = $this->validateRequest($request);
        $section = $activity->sections()->create($data);
        //return 'stored';
        return redirect("sections/$section->id")->with('success',"$section->title has been created !");
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        $actual_time = $this->timeDurationFormatter($section->time_duration);
        return view('sections.show', compact('section','actual_time'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section)
    {
        
        $actual_time = $this->timeDurationFormatter($section->time_duration);
        return view('sections.edit',compact('section','actual_time'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Section $section)
    {
        //return 'works';
        $data = $this->validateRequest($request);
        $section->update($data);
        return redirect("sections/$section->id")->with('success',"$section->title has been updated !");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Section $section)
    {
        $activity_id = $section->activity->id;
        $section_title = $section->title;
        $section->delete();
        return redirect("sections/$activity_id/activity")->with('success',"$section_title has been deleted !");
    }

    // just the sections belonging to activity
    public function index(Activity $activity)
    {
        //return 'works'
        $sections = Section::with('activity')->where('activity_id',$activity->id)->orderBy('created_at','desc')->paginate(10);
        return view('sections.index', compact('sections','activity'));
    }

    // SECTION SAVING ITS OWN QUESTIONS

    // a single question

    public function save_question(Section $section, Request $request)
    {
        //return $section;
        $data = $this->validateAddQuestionRequest($section,$request);
        //return $data;
        $question;
        if ($data['id'] != null) {
           //return 'works';
            $question = Question::find($data['id']);
            $question->update($data);
        }else {
            
            $question = $section->questions()->create($data);
        }
        
        //return $question;
        return new QuestionResource(Question::find($question->id));// eliminates null being returned as the mark to default value
        
    }

    public function questions_index(Section $section)
    {
        //return 'works';
        $questions  = $section->questions;
        return QuestionResource::collection($questions);        
    }














    //Validation of Requests
    private function validateRequest($request){
        $data = $request->validate([
            'title'=>'required',
            'instruction'=>'required',
            'time_duration'=>'required',
            'contribution_to_activity'=>'required',
            'category'=>'required'
            

        ]);

        //convert time_duration to milliseconds
        $time  = explode(':',$data['time_duration']);
        //convert hrs to mill
        $hrs = $time[0] * 60*60*1000;
        //convert min to milli
        $min = $time[1] *60*1000;

        //add
        $time = $hrs + $min ;
        // give it back
        $data['time_duration'] = $time;
        // send data 
        return $data;



    }

    private function validateAddQuestionRequest($section, $request){
        $data;
        
        if ($section->category == 'MCQ') {
            //return 'e de';
            $data = $request->validate([
                'content'=>'required',
                'option_a'=>'required',
                'option_b'=>'required',
                'option_c'=>'required',
                'option_d'=>'required',
                'correct_answer'=>'required',
                'id'=> 'sometimes'
                
    
            ]);
            
        }

        if ($section->category == 'Theory') {
            $data = $request->validate([
                'content'=>'required',
                'mark'=>'required',
                'id'=> 'sometimes'
    
            ]);
        }
        
        if ($section->category == 'Uploads') {
            return 'not ready for uploads';
        }

        
        return $data;



    }

    // time_duration_formatter
    private function timeDurationFormatter($time)
    {
        
        $hr = floor($time/(1000*60*60));
        $min = floor($time%(1000*60*60))/(1000*60);
        return "$hr:$min";
    }
}
