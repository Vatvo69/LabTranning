<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use Auth;

class GameController extends Controller
{
    public function gameList(Request $request){
        $game=Game::all();
        return view('game.list',['game'=>$game]);
    }
    public function addGame(Request $request){
        return view('game.add');
    }
    public function saveGame(Request $request){
        $game=new Game();
        if($request->hasFile('fileGame')){
            $file=$request->file('fileGame');
            $name=$file->getClientOriginalName('fileGame');
            $ext=$file->getClientOriginalExtension('fileGame');
            $file_name=explode('.',$name);
            if($ext=='txt'){
                $file->move('game',$name);
                $game=new Game();
                $game->teacherId=Auth::user()->id;
                $game->title=$request->title;
                $game->hint=$request->hint;
                $game->file=$file_name[0];
                $game->save();
                return redirect()->route('gameList')->with('addSuccess',true);
            }
            return redirect()->back()->with('error','Upload File Only TXT!');
        }
        return redirect()->back()->with('error','File Upload Not Empty!');
    }

    public function deleteGame(Request $request,$id){
        $game=Game::find($id);
        $game->delete();
        return redirect()->back()->with('deleteSuccess',true);
    }

    public function detailGame(Request $request,$id){
        $game=Game::find($id);
        return view('game.detail',compact('game'));
    }

    public function answerGame(Request $request,$id){
        $game=Game::find($id);
        if($game->file==$request->answer){
            return redirect()->back()->with('mess',true);
        }
        return redirect()->back()->with('error',true);
    }
}
