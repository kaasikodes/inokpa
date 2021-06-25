<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Section;
use App\User;
use App\Submission;

class SubmissionsController extends Controller
{
    public function log_section(Section $section, User $user)
    {
        Submission::create([
            'section_id' => $section->id,
            'user_id' => $user->id,
            'activity_id' => $section->activity->id
        ]);
        return redirect('/activities'.'/'.$section->activity->id)->with('success',"Congrats, you are done with $section->title section of this activity.");

    }
}
