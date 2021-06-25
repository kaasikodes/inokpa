<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File;
use Illuminate\Support\Facades\Storage;
class FilesController extends Controller
{
    public function edit(File $file)
    {
        return view('files.edit',compact('file'));
    }

    
    public function update(Request $request, File $file)
    {
        $data  = $this->validatefileRequest($request);
        //return $data; later provide means to update file in view and controller
        $lesson_id = $file->lesson->id;
        $lesson_title = $file->lesson->title;
        $file->update($data);
        return redirect("files/$lesson_id/course")->with('success',"A file has been updated in $lesson_title");
    }

    
    public function destroy(File $file)
    {
        $lesson_id = $file->lesson->id;
        $file_text = $file->text;
        Storage::delete("public/$file->name");
        $file->delete();
        
        return redirect("files/$lesson_id/course")->with('success',"$file_text has been deleted !");
    }

    public function download(File $file)
    {
       
       
       
        return response()->download("storage/$file->name",$file->text);
    }

    //validate request
    private function validateFileRequest($request){
        //dd($request->hasFile('upload'));
        //if ($request->hasFile('upload')) {
            //return 2;
            return $request->validate([
                'text'=>'required',
                'upload'=>'',
                
    
            ]);
        }
        
        

    //} not needed just updating the text
}
