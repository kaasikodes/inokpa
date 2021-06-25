<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/





Route::get('/','WelcomeController@show');
Route::view('/vue','welcome');//vue testing

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Courses Controller
Route::resource('courses',CoursesController::class);
Route::post('search_courses','CoursesController@search')->name('courses.search');
Route::get('search_courses/{title}','CoursesController@searchResults');
Route::post('courses/{course}/enroll','CoursesController@enrollAStudent')->name('courses.enroll');
Route::get('courses/{course}/unenroll','CoursesController@unenrollAStudent')->name('courses.unenroll');
Route::get('student_courses','CoursesController@student_index')->name('courses.student_index');
Route::get('teacher_courses','CoursesController@teacher_index')->name('courses.teacher_index');

//Lessons Controller
Route::get('lessons/create/{course}','LessonsController@create')->name('lessons.create');
Route::post('lessons/{course}','LessonsController@store')->name('lessons.store');
Route::get('lessons','LessonsController@index')->name('lessons.index');
Route::get('lessons/{course}/course','LessonsController@course_index')->name('lessons.course_index');
Route::get('lessons/{lesson}/{slug}','LessonsController@show')->name('lessons.show');
Route::get('lessons/{lesson}/{slug}/edit','LessonsController@edit')->name('lessons.edit');
Route::put('lessons/{lesson}/{slug}','LessonsController@update')->name('lessons.update');
Route::delete('lessons/{lesson}','LessonsController@destroy')->name('lessons.destroy');
Route::post('search_lessons','LessonsController@search')->name('lessons.search');
Route::get('search_lessons/{title}','LessonsController@searchResults');
//links are created and stored from the lessons controller via a relationship
Route::get('links/create/{lesson}','LessonsController@create_link')->name('links.create');
Route::post('links/{lesson}','LessonsController@store_link')->name('links.store');
Route::get('links/{lesson}/course','LessonsController@links_index')->name('links.index');
//links a are editted, updated, and deleted via the links controller
Route::delete('links/{link}','LinksController@destroy')->name('links.destroy');
Route::get('links/{link}/edit','LinksController@edit')->name('links.edit');
Route::put('links/{link}','LinksController@update')->name('links.update');
//files are created and stored from the lessons controller via a relationship
Route::get('files/create/{lesson}','LessonsController@create_file')->name('files.create');
Route::post('files/{lesson}','LessonsController@store_file')->name('files.store');
Route::get('files/{lesson}/course','LessonsController@files_index')->name('files.index');
//files a are editted, updated, and deleted via the files controller
Route::delete('files/{file}','FilesController@destroy')->name('files.destroy');
Route::get('files/{file}/edit','FilesController@edit')->name('files.edit');
Route::put('files/{file}','FilesController@update')->name('files.update');
Route::get('files/{file}/download','FilesController@download')->name('files.download');
// dashboard student
Route::get('student_lessons','LessonsController@student_index')->name('lessons.student_index');
// dashboard teacher
Route::get('teacher_lessons','LessonsController@teacher_index')->name('lessons.teacher_index');

// Activities Controller
Route::get('activities/create/{course}','ActivitiesController@create')->name('activities.create');
Route::post('activities/{course}','ActivitiesController@store')->name('activities.store');
Route::get('activities/{activity}','ActivitiesController@show')->name('activities.show');
Route::get('activities/{activity}/edit','ActivitiesController@edit')->name('activities.edit');
Route::put('activities/{activity}','ActivitiesController@update')->name('activities.update');
Route::delete('activities/{activity}','ActivitiesController@destroy')->name('activities.destroy');
Route::get('activities/{course}/course','ActivitiesController@course_index')->name('activities.course_index');
Route::get('activities','ActivitiesController@index')->name('activities.index');
Route::post('search_activities','ActivitiesController@search')->name('activities.search');
Route::get('search_activities/{title}','ActivitiesController@searchResults');
// dashboard student
Route::get('student_activities','ActivitiesController@student_index')->name('activities.student_index');
// dashboard teacher
Route::get('teacher_activities','ActivitiesController@teacher_index')->name('activities.teacher_index');


// return submissions
Route::get('submissions/{activity}','ActivitiesController@submissions_index')->name('activity.submissions'); // for single activity n all persons
Route::get('submissions/{activity}/{student}/student','ActivitiesController@submissions_student')->name('activity.submissions.student'); // for single activity n person

// Sections Controller
Route::get('sections/create/{activity}','SectionsController@create')->name('sections.create');
Route::post('sections/{activity}','SectionsController@store')->name('sections.store');
Route::get('sections/{section}','SectionsController@show')->name('sections.show');
Route::get('sections/{section}/edit','SectionsController@edit')->name('sections.edit');
Route::put('sections/{section}','SectionsController@update')->name('sections.update');
Route::delete('sections/{section}','SectionsController@destroy')->name('sections.destroy');
Route::get('sections/{activity}/activity','SectionsController@index')->name('sections.index');



// Answers  Controller
Route::get('answers/create/{section}','AnswersController@create')->name('answers.create');




// Submissions Controller
Route::get('submissions/{section}/{user}/log','SubmissionsController@log_section')->name('submissions.log_section');//section 4 student submissions log


// Assessments Controller
//start wit subs as they create assmnts n all
Route::get('assessments/{course}/course','AssessmentsController@course_index')->name('assessments.course_index');// all the assessments for a activities in a course
Route::get('assessments/{activity}/activity','AssessmentsController@activity_index')->name('assessments.activity_index');// all the assessments for a section in an activity
Route::get('assessments/{section}/{student}/create','AssessmentsController@create')->name('assessments.create');// assessments for a section n singlr persom
Route::get('assessments/{course}/{user}/course','AssessmentsController@student_course_index')->name('assessments.student_course_index');
Route::get('assessments/{section}/{user}/log','AssessmentsController@log_section')->name('assessments.log_section');//section 4 student asessment log


//Dashboard Controller
Route::get('/student/dashbaord','DashboardController@student')->name('dashboard.student');
Route::get('/teacher/dashbaord','DashboardController@teacher')->name('dashboard.teacher');



//DevMessages Controller
Route::post('/devMessage','DevMessagesController@store')->name('developer.message');
Route::get('/devMessages','DevMessagesController@index');
Route::get('/hire-a-developer','DevMessagesController@hire')->name('developer.hire');
Route::get('/support','DevMessagesController@support')->name('developer.support');




// Pages Controller to take care of about  page 4 now
Route::get('/{title}/page','PagesController@show')->name('pages.page');
Route::get('/pages/{title}/edit','PagesController@edit');
Route::get('/pages/create','PagesController@create');
Route::post('/pages/store','PagesController@store')->name('pages.store');
Route::put('/pages/store','PagesController@store')->name('pages.store');



//Notifications Controller
Route::get('/notifications','NotificationsController@index')->name('notifications.index');















Route::get('test',function()
{
    $user =  App\User::first();
    $courses =  App\Course::all();
    $user->courses()->syncWithoutDetaching([
        12 =>[
            'role'=>'teacher'
        ],
        13 =>[
            'role'=>'student'
        ]

    ]);
    //dd($user->courses->first()->pivot->role);

    foreach ($courses as $course) {
        $course->users()->syncWithoutDetaching([
            12 =>[
            'role'=>'teacher'
        ],

        ]);
    }
});
