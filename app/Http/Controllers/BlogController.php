<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

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
        Post::find($id)->increment('views');
        $data=Post::find($id);
        return view('singlepost',['title'=>'Single Post','data'=>$data]);
    }

    public function getcategory(){
        $data=Category::orderBy('id','DESC')->paginate(1);
        return view('allcategory',['data'=>$data]);
    }

    public function getcategoryposts(Request $request){
        $category=Category::find($request->id);
        $data=Post::Where('category_id','=',$request->id)->orderBy('id','DESC')->paginate(2);
        return view('categoryposts',['data'=>$data,'title'=>$category->title]);
    }

}
