<?php

use App\Http\Controllers\ProfileController;use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\UserController;use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;use App\Http\Controllers\FriendController;
use App\Http\Controllers\CommentController;use App\Http\Controllers\ChatController;
use App\Http\Controllers\EducationController;use App\Http\Controllers\WorkController;
use App\Http\Controllers\ProjectController;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function (Request $req) {
    if($req->query('form')){
        return view('lander',array_merge(['form'=>'login'],['user'=>Auth::user()]));
    }
     else{
        return view('lander',array_merge(['form'=>'signup'],['user'=>Auth::user()]));
    }
})->name('main.show');

Route::post('/registeruser', [RegisteredUserController::class,'store']);

Route::middleware('auth')->group(function () {
    Route::resource('jobs',JobController::class);
    Route::get('/profile/edit',[UserController::class,'edit'])->name('user.edit');
    Route::get('/profile/{userid}',[UserController::class,'show']);
    Route::get('/profile',[UserController::class,'show'])->name('user.show');
    Route::resource('project',ProjectController::class);
    Route::resource('education',EducationController::class);
    Route::resource('work',WorkController::class);
    Route::resource('posts.comments',CommentController::class);
    Route::resource('posts',PostController::class);
    Route::resource('likes',LikeController::class);
    Route::prefix('/friends')->group(function (){
        Route::get('/request',[FriendController::class,'sendRequest']);
        Route::get('/follow/{id}',[FriendController::class,'acceptRequest']);
    });
    Route::prefix('/chats')->group(function (){
        Route::get('/',[ChatController::class,'list']);
        Route::put('/create',[ChatController::class,'add']);
        Route::put('/destroy',[ChatController::class,'del']);
    });
});


require __DIR__.'/auth.php';
