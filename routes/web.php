<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;





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
Route::view('/','admin.index');
Route::get('/login', function () {
    return view('admin.login');
});
Route::view('register','admin.register');
Route::post('register',[AdminController::class,'register']);
Route::post('login',[AdminController::class,'login']);
Route::get('/logout',function(){
    if(Session::has('user')){
        Session::flush('user');
        return redirect('/login');

    }
});
Route::resource('admin/category',CategoryController::class);
Route::get('admin/postlist',[PostController::class,'index']);
Route::get('admin/post/create',[PostController::class,'create']);
Route::post('admin/post/create',[PostController::class,'addpost']);
Route::delete('admin/post/{id}',[PostController::class,'deletepost']);
Route::get('admin/post/{id}',[PostController::class,'editpost']);
Route::post('admin/post/editpost',[PostController::class,'updatepost']);
Route::get('admin/settings',[SettingController::class,'index']);
Route::post('admin/settings',[SettingController::class,'addsettings']);
Route::get('blog',[BlogController::class,'index']);
Route::get('singlepost/{id}',[BlogController::class,'getsinglepost']);
Route::post('addcomment',[CommentController::class,'addcomment']);










