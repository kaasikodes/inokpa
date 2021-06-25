<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Question;
use App\Http\Resources\Question as QuestionResource;

class QuestionsController extends Controller
{
    public function show(Question $question)
    {
        return new QuestionResource($question);
    }
    public function update(Question $question, Request $request)
    {
        //return 'popoi';
        $data = $this->validateRequest($request);
        return $data;

        $question->update($data);
        return new QuestionResource($question);
    }

    public function delete(Question $question)
    {
        $question->delete();
    }

    private function validateRequest($request)
    {
        //return 'so sorry';
        $data = $request->validate([
            'content'=>'required',
            'option_a'=>'required',
            'option_b'=>'required',
            'option_c'=>'required',
            'option_d'=>'required',
            'correct_answer'=>'required',
            

        ]);
        return $data;
    }
}
