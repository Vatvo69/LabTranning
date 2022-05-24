<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Submit;
use Auth;

class SubmitController extends Controller
{
    public function saveSubmit(Request $request,$id){   
        if($request->hasFile('fileSubmit')){
            $file=$request->file('fileSubmit');
            $name=$file->getClientOriginalName('fileSubmit');
            $ext=$file->getClientOriginalExtension('fileSubmit');
            $file_name=time().'_'.$name;
            $allow=['pdf', 'txt', 'docx'];
            if(in_array($ext,$allow)){
                $file->move('classroom/student',$file_name);
                $submit=new Submit();
                $submit-> title=$request->title;
                $submit-> studentId=Auth::user()->id;
                $submit-> exerciseId=$id;
                $submit->studentName = Auth::user()->username;
                $submit-> file=$file_name;
                $submit->save();
                return redirect()->back()->with('submitSuccess',true);
            }
            return redirect()->back()->with('errorSubmit','File Not Allow!');
        }
        return redirect()->back()->with('errorSubmit','File Not Empty');
    }

    public function deleteSubmit(Request $request,$id){
        $submit=Submit::find($id);
        $submit->delete();
        return redirect()->back()->with('deleteSuccess',true);
    }

    public function detailSubmit(Request $request,$id){
        $submit=Submit::find($id);
        return view('classroom.detailSubmit',['submit'=>$submit]);
    }
}
