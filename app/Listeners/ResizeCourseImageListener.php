<?php

namespace App\Listeners;

use App\Events\CourseCreatedWithImage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Intervention\Image\Facades\Image;

class ResizeCourseImageListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CourseCreatedWithImage  $event
     * @return void
     */
    public function handle(CourseCreatedWithImage $event)
    {
        $image = Image::make(public_path('storage/'. $event->course->image))->fit(562,120); // default is center - jst to rmnd u of format
        $image->save();
    }
}
