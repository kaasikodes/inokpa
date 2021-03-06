<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class NotificationsController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->unReadNotifications;
        return view('notifications.index',compact('notifications'));
    }
}
