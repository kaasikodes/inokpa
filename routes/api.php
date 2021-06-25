<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// List articles
Route::get('articles', 'ArticlesController@index');
// List article
Route::get('articles/{article}', 'ArticlesController@show');
//create article
Route::post('article', 'ArticlesController@store');
//store article
Route::put('article', 'ArticlesController@store');
//delete article
Route::delete('article', 'ArticlesController@destroy');

Route::view('test','test');



// MAIN APPLICATION
//section adding a question
Route::post('questions/{section}', 'SectionsController@save_question');
// return a single question
Route::get('questions/{question}', 'QuestionsController@show');
// delete a question
Route::get('questions/{question}/delete', 'QuestionsController@delete');
// return the questions for the entire section
Route::get('questions/{section}/all', 'SectionsController@questions_index');


// ANSWERS
Route::post('answers/{section}', 'AnswersController@save');
// return a single answer
Route::get('answers/{user}/{question}/check', 'AnswersController@check_for_answer');
// return a single answer
Route::get('answers/{answer}', 'AnswersController@show');


//SECTION TIME
//update the time
Route::get('sectiontimes/{sectionTime}/{time_left}', 'SectionTimesController@update');


// Assessment Controller
Route::post('assessments/{answer}/save', 'AssessmentsController@save_score');
Route::get('assessments/{answer}/show', 'AssessmentsController@show_score');