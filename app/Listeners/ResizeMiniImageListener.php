<?php

namespace App\Listeners;

use App\Events\CourseCreatedWithImage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Intervention\Image\Facades\Image;

class ResizeMiniImageListener implements ShouldQueue
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
         // make mini image - that is a resized version of image to show snippet
         $mini_image = Image::make(public_path('storage/'. $event->course->mini_image))->fit(300,300); // default is center - jst to rmnd u of format
         $mini_image->save();
    }
}
