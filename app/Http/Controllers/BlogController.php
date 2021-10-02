<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class BlogController extends Controller
{
    //
    public function index(Request $req){
        $query=$req->input('query');
        if($query){
        $data=Post::Where('title','like','%'.$query.'%')->orderBy('id','DESC')->paginate(3);
        }
        else{
        $data=Post::orderBy('id','DESC')->paginate(3);
        }
        return view('home',['title'=>'Home Page','data'=>$data]);
    }

    public function getsinglepost($id){
        $data=Post::find($id);
        return view('singlepost',['title'=>'Single Post','data'=>$data]);
    }

}
