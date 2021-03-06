<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassRoom;
use App\Models\Submit;
use Illuminate\Support\Facades\Storage;
use Auth;

class ClassRoomController extends Controller
{
    public function listExercise(Request $request){
        $exercise=ClassRoom::all();
        return view('classroom.list',['exercise'=>$exercise]);
    }
    public function addExercise(Request $request){
        return view('classroom.add');
    }
    public function saveExercise(Request $request){
        if($request->hasFile('file')){
            $file=$request->file('file');
            $name=$file->getClientOriginalName('file');
            $ext=$file->getClientOriginalExtension('file');
            $name_file = time().'_'.$name;
            $allow=['txt','pdf','docx'];
            if(in_array($ext,$allow)){
                // $file->move('classroom/teacher',$name_file);
                $file->storeAs('public/classroom/teacher',$name_file);
                $exercise=new ClassRoom();
                $exercise->teacherId=Auth::user()->id;
                $exercise->title=$request->title;
                $exercise->description=$request->description;
                $exercise->file=$name_file;
                $exercise->save();
                return redirect()->route('exerciseList')->with('addSuccess',true);
            }
            return redirect()->back()->with('errorExt',true);
        }
        return redirect()->back()->with('error',true);
    }
    public function deleteExercise(Request $request,$id){
        $e=ClassRoom::find($id);
        if($e->teacherId==Auth::user()->id){
            $e->delete();
            return redirect()->back()->with('deleteSuccess',true);
        }
        return redirect()->back();
    }

    public function detailExercise(Request $request,$id){
        $e=ClassRoom::find($id);
        $submit=Submit::where('exerciseId',$id)->get();
        return view('classroom.detail',['exercise'=>$e,'submit'=>$submit]);
    }

    public function download(Request $request,$id){
        $e=ClassRoom::find($id);
        // $path_download='storage/classroom/teacher/'.$e->file;
        $path_download=storage_path('app/public/classroom/teacher/'.$e->file);

        if(file_exists($path_download)){
            // return Storage::download($e->file);
            return response()->download($path_download);
        }
        return redirect()->back()->with('error',true);
    }
}
