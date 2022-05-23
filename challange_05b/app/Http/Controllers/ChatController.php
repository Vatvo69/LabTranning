<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Chat;
use Auth;

class ChatController extends Controller
{
    public function sendChat(Request $request,$id){
        $chats=Chat::where(function($query) use ($id){
            $query->where('sendId',$id)->where('recvId',Auth::user()->id);
        }) -> orWhere(function($query) use ($id){
            $query->where('sendId',Auth::user()->id)->where('recvId',$id);
        }) -> get();
        $user=User::find($id);
        return view('chat.sendChat',['user'=>$user,'chats'=>$chats]);
    }

    public function insertChat(Request $request,$id){
        if($request->has('sendBtn')){
            $request->validate([
                'content'=>['required','string']
            ]);
            $newChat=new Chat();
            $newChat->sendId=Auth::user()->id;
            $newChat->recvId=$id;
            $newChat->content=$request->content;
            $newChat->save();
            return redirect()->back()->with('sendSuccess',true);
        }
        elseif($request->has('editChat')){
            $chat=Chat::findOrFail($id);
            if($chat['sendId']==Auth::user()->id){
                $chat->content=$request->content;
                $chat->save();
                return redirect()->back()->with('editSuccess',true);
            }
        }
        elseif($request->has('deleteChat')){
            $chat=Chat::findOrFail($id);

            $chat->delete();
            return redirect()->back();
        }
    }
}
