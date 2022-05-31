<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ClassRoomController;
use App\Http\Controllers\SubmitController;
use App\Http\Controllers\GameController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('get_upload/{path}/{filename}',function($path,$filename){
    $path=storage_path('app/public/'.$path.'/'.$filename);
    if(file_exists($path)){
        return response()->file($path);
    }
    abort(404);
});
Route::get('login',[LoginController::class,'login'])->name('login');

Route::post('login',[LoginController::class,'postLogin'])->name('postLogin');

Route::get('logout',[LoginController::class,'logout'])->name('logout');

Route::middleware(['checklogin'])->group(function () {
    Route::get('/',[LoginController::class,'index'])->name('indexPage');

    Route::get('/user/changePassword',[UserController::class,'changePassword'])->name('changePassword');

    Route::post('/user/changePassword',[UserController::class,'updatePassword'])->name('updatePassword');

    Route::get('/user/list',[UserController::class,'list'])->name('listUser');

    Route::get('/user/profile',[UserController::class,'profile'])->name('profile');

    Route::get('/user/profile/edit',[UserController::class,'editProfile'])->name('editProfile');

    Route::post('/user/profile/edit',[UserController::class,'updateProfile']);

    Route::get('/user/profile/changePassword',[UserController::class,'changePassword'])->name('changePassword');

    Route::get('/user/list',[UserController::class,'listUser'])->name('listUser');

    Route::get('/user/detail/{id}',[UserController::class,'detailUser'])->name('detailUser');
    
    Route::get('/user/sendChat/{id}',[ChatController::class,'sendChat'])->name('sendChat');

    Route::post('/user/sendChat/{id}',[ChatController::class,'insertChat']);

    Route::middleware(['isTeacher'])->group(function () {
        Route::get('/user/add',[UserController::class,'addUser'])->name('addUser');

        Route::post('/user/add',[UserController::class,'saveUser']);

        Route::get('/user/editUser/{id}',[UserController::class,'editUser'])->name('editUser');

        Route::post('/user/editUser/{id}',[UserController::class,'updateUser'])->name('updateUser');

        Route::get('/user/deleteUser/{id}',[UserController::class,'deleteUser'])->name('deleteUser');

        Route::get('/exercise/list',[SubmitController::class,'listSubmit'])->name('listSubmit');

        Route::get('/submit/delete/{id}',[SubmitController::class,'deleteSubmit'])->name('deleteSubmit');

        Route::get('/submit/detail/{id}',[SubmitController::class,'detailSubmit'])->name('detailSubmit');
    });
    Route::get('/classroom/download/{id}',[ClassRoomController::class,'download'])->name('download');
    
    Route::get('/classroom/list',[ClassRoomController::class,'listExercise'])->name('exerciseList');

    Route::get('/classroom/add',[ClassRoomController::class,'addExercise'])->name('addExercise');

    Route::post('/classroom/add',[ClassRoomController::class,'saveExercise']);

    Route::get('/classroom/deleteExercise/{id}',[ClassRoomController::class,'deleteExercise'])->name('deleteExercise');

    Route::get('/classroom/detail/{id}',[ClassRoomController::class,'detailExercise'])->name('detailExercise');

    Route::middleware(['isStudent'])->group(function () {
        Route::post('/exercise/submit/{id}',[SubmitController::class,'saveSubmit'])->name('saveSubmit');
    });
    Route::get('/game/list',[GameController::class,'gameList'])->name('gameList');

    Route::get('/game/add',[GameController::class,'addGame'])->name('addGame');

    Route::post('/game/add',[GameController::class,'saveGame']);

    Route::get('/game/delete/{id}',[GameController::class,'deleteGame'])->name('deleteGame');

    Route::get('/game/detail/{id}',[GameController::class,'detailGame'])->name('detailGame');

    Route::post('/game/answer/{id}',[GameController::class,'answerGame'])->name('answerGame');
});

