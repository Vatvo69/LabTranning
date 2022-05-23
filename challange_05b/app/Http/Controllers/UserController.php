<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
class UserController extends Controller
{
    public function profile(Request $request){
        $user=Auth::user();
        return view("user.profile",['user'=>$user]);
    }

    public function editProfile(Request $request){
        $user=Auth::user();
        return view("user.editProfile",['user'=>$user]);
    }

    public function updateProfile(Request $request){
        $request->validate([
            'email'=>['email','required'],
            'phone'=>['digits_between:8,10','required'],
            'username'=>['required'],
            'fullname'=>['required']
        ]);
        if ($request->hasFile('image')){
            $file = $request->file('image');
            $name = $file->getClientOriginalName('image');
            $ext=$file->getClientOriginalExtension('image');
            $name_file=time().'_'.$name;
            $allow=['jpg','png','jpeg'];
            if(in_array($ext,$allow)){
                $file->move('image',$name_file);
            }
            
            $user=User::find(Auth::user()->id);
            $user->email=$request->email;
            $user->phone=$request->phone;
            $user->imagePath=$name_file;
            if(Auth::user()->role==1){
                $user->username=$request->username;
                $user->fullname=$request->fullname;
            }
            $user->save();
            return redirect()->route('profile')->with('message','Update Success!');
        }
        else{
            return redirect()->route('editProfile')->with('error','File Image Empty!');
        }
    }

    public function changePassword(Request $request){
        return view('user.changePassword');
    }

    public function updatePassword(Request $request){

        $user=Auth::user();
        $user->password=bcrypt($request->password);
        $user->save();
        return redirect()->back()->with('updateSuccess',true);

    }
    public function listUser(){
        $user=User::all();
        return view('user.listUser',['user'=>$user]);
    }

    public function detailUser(Request $request,$id){
        $user=User::find($id);
        return view('user.detail')->with('user',$user);
    }

    public function addUser(){
        return view('user.add');
    }

    public function saveUser(Request $request){
        if($request->hasFile('image')){
            $file = $request->file('image');
            $name = $file->getClientOriginalName('image');
            $ext= $file->getClientOriginalExtension('image');
            $name_file = time().'_'.$name;
            $allow=['jpg','png','jpeg'];
            if(in_array($ext,$allow)){
                $file->move('image',$name_file);
            }
            $user=new User();
            $user->username=$request->username;
            $user->password=bcrypt($request->password);
            $user->imagePath=$name_file;
            $user->fullname=$request->fullname;
            $user->email=$request->email;
            $user->phone=$request->phone;
            $user->role="0";
            $user->save();
            return redirect()->route('listUser')->with('addSuccess','Add User Success!');
        }
        return redirect()->route('addUser')->with('error','File Image Empty!');
    }

    public function editUser(Request $request,$id){
        $user=User::find($id);
        return view('user.editUser',['user'=>$user]);
    }
    public function updateUser(Request $request,$id){
        $request->validate([
            'email'=>['email','required'],
            'phone'=>['digits_between:8,10','required'],
            'username'=>['required'],
            'fullname'=>['required']
        ]);
        if ($request->hasFile('image')){
            $file = $request->file('image');
            $name = $file->getClientOriginalName('image');
            $ext=$file->getClientOriginalExtension('image');
            $name_file=time().'_'.$name;
            $allow=['jpg','png','jpeg'];
            if(in_array($ext,$allow)){
                $file->move('image',$name_file);
            }
            
            $user=User::find($id);
            $user->email=$request->email;
            $user->phone=$request->phone;
            $user->imagePath=$name_file;
            $user->username=$request->username;
            $user->fullname=$request->fullname;
            $user->save();
            return redirect()->route('detailUser',$id)->with('updateSuccess','Update User Success!');
        }
        else{
            return redirect()->route('editUser',$id)->with('error','File Image Empty!');
        }
    }
    public function deleteUser(Request $request,$id){
        $user=User::find($id);
        $user->delete();
        return redirect()->back()->with('deleteSuccess','Delete User Success');
    }
}
