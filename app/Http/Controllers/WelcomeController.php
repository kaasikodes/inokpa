<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;

class WelcomeController extends Controller
{
    public function show()
    {
        $courses = Course::all();
        return view('welcome1')->with([
            'courses' => $courses,

        ]);
    }
}
