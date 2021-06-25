<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SectionTime;

use App\Http\Requests;

class SectionTimesController extends Controller
{
    public function update(SectionTime $sectionTime, $time_left)
    {
        $sectionTime->update([
            'time_left' => $time_left
        ]);
        return $sectionTime->time_left;
        
    }
}
