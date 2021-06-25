<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DevMessage;

class DevMessagesController extends Controller
{
    public function store(Request $request)
    {
        //return 'works';
        $data = $this->validateRequest($request);
        DevMessage::create($data);
        if ($data['type'] == 'job') {
            return redirect('/hire-a-developer')->with('success','Thanks, your offer is under consideration!');
        }

        if ($data['type'] == 'support') {
            return redirect('/support')->with('success','Sorry, the inconvenience. We\'ll get back to you immediately');
        }
        return redirect('/#messages')->with('success','Thanks, I\'ll get back to you soon enough!');
    }


    public function index()
    {
        $messages  = DevMessage::orderBy('created_at','desc')->paginate(10);
        return view('devMessages.index', compact('messages'));
    }

    public function hire()
    {
        return view('devMessages.hire');
    }

    public function support()
    {
        return view('devMessages.support');
    }




    private function validateRequest($request)
    {
        return $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'phone'=> 'required',
            'message'=>'required',
            'hire_request'=>'sometimes',
            'budget'=>'sometimes',
            'project_title'=>'sometimes',
            'type'=>'sometimes'

        ]);
        
    }
}
