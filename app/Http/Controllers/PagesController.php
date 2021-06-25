<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;

class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',[
            'except'=>['show']
            ]);
    }



    public function show($title)
    {
        $page = Page::where('title',$title)->first();// try a find or fail
        return view('pages.show',compact('page'));
    }

    public function edit($title)
    {
        $page = Page::where('title',$title)->first();// try a find or fail
        return view('pages.edit',compact('page'));
    }

    public function create()
    {
        
        return view('pages.create');
    }

    public function store(Request $request)
    {
        //return 'hits';
        $data = $this->validateRequest($request);
        //return $data;
        
        $page = $request->isMethod('put') ? Page::where('title',$data['title'])->first()->update($data) :  Page::create($data);
        $page = Page::where('title',$data['title'])->first();
        return redirect("$page->title/page");
    }




    //validations

    private function validateRequest($request){
        return $request->validate([
            'title'=>'required',
            'content'=>'required',
            

        ]);

    }

}
