<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;
use App\Section;
use App\SectionTime;
use App\Http\Requests;
use App\Http\Resources\Answer as AnswerResource;

class AnswersController extends Controller
{
    


    public function index()
    {
        return 'errant';
    }


    
    
    public function create(Section $section)
    {
        //return 'working';
        $actual_time = $this->timeDurationFormatter($section->time_duration);
        // create the section time for the user
        $sectionTime;
        if ($sectionTime = SectionTime::where('user_id',auth()->user()->id)->where('section_id',$section->id)->first()) {
            // section is already set from above code
        }else{
            $sectionTime  = SectionTime::create([
                'section_id'=> $section->id,
                'user_id'=>auth()->user()->id,
                'time_left'=> $section->time_duration
            ]);

            // create the submission log for the answers
            $section->submissions()->create([
                'section_id'=> $section->id,
                'user_id'=>auth()->user()->id,
                'activity_id'=> $section->activity->id,

            ]);

        }
        
        //return $sectionTime->id;

        return view('answers.create', compact('section','actual_time','sectionTime'));
    }

    public function save(Request $request)
    {
        //return 'works wel';
        $data = $this->validateRequest($request);
        //return auth()->user()->id;
        //return $data['content'];
        

        //correction of adding an activity_id
        $data['activity_id'] = Section::find($data['section_id'])->activity_id;
        //correction of adding an activity_id
        $answer = $data['id'] != null ? Answer::findOrFail($data['id']) : Answer::create($data);
        //return $answer;
        
        $answer->update([
            'content' => $data['content'],
            //'score' => $data['score'] != null ? $data['score'] : 0 
        ]);
        //return $answer;
        
        return new AnswerResource($answer);
    }


    //check_for_answer
    public function check_for_answer($user,$question)
    {
        
        $answer;
        if ( Answer::userAnswer($user,$question)->first() != null) {
            $answer = Answer::userAnswer($user,$question)->first();
            return $answer;
            return redirect("/api/answers/$answer->id");
        }
        //return Answer::userAnswer(12,4)->first();
        
        return 0;
    }

    //shaow answer
    public function show(Answer $answer)
    {
        return new AnswerResource($answer);
    }





    // time_duration_formatter
    private function timeDurationFormatter($time)
    {
        
        $hr = floor($time/(1000*60*60));
        $min = floor($time%(1000*60*60))/(1000*60);
        return "$hr:$min";
    }

    private function validateRequest($request)
    {
        //return 'works';
        $data = $request->validate([
            'content' => 'required',
            'question_id'=> 'required',
            'section_id'=> 'required',
            'user_id'=> 'required',
            'id'=>'',
            
            

        ]);
        
        return $data;
    }
}
