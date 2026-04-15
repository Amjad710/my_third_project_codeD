<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\SessionController;
use App\Http\Controllers\IdeaController;
use App\Models\Idea;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function(){
//index
Route::get('/ideas', [IdeaController::class,'index']);
//create
Route::get('/ideas/create',[IdeaController::class ,'create']);

//show
Route::get('/ideas/{idea}',[IdeaController::class,'show']);

//edit
Route::get('/ideas/{idea}/edit',[IdeaController::class,'edit']);

//update
Route::patch('/ideas/{idea}',[IdeaController::class,'update']);
//store
Route::post('/ideas',[IdeaController::class ,'store']);
//destroy
Route::delete('/ideas/{idea}',[IdeaController::class,'destroy']);
//logout
Route::delete('/logout',[SessionController::class,'destroy']);
});

Route::get('/about', function () {
    return view('about');
});


Route::view('/contact','contact');//another way of Routing

Route::middleware('guest')->group(function(){
//auth
Route::get('/register',[RegisteredUserController::class,'create']);
Route::post('/register',[RegisteredUserController::class,'store']);

Route::get('/login',[SessionController::class,'create'])->name('login');
Route::post('/login',[SessionController::class,'store']);
});

Route::get('/admin',function(){
return 'private';
})->can('view-admin');