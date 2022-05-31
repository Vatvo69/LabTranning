<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class LoginController extends Controller
{
    public function login(){
        return view('login');
    }
    public function postLogin(Request $request){
        if(Auth::attempt(['username' => $request->username, 'password' => $request->password])){
            return redirect()->route('indexPage');
        }
        else {
            return redirect()->route('login')->with('error',"Wrong Username Or Password!");
        }
    }

    public function index(){
        return view('user.index');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
