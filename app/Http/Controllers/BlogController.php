<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

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

    public function addpost(){
        $data=Category::all();
        return view('addpost',['data'=>$data]);
    }

    public function createpost(Request $request){
        $validator=Validator::make($request->all(),[
            'title'=>'required | max:20',
            'detail'=>'required  | max:200',
            'thumb'=>'required | image | mimes:jpeg,jpg | max:1000',
            'fullimg'=>'required | image | mimes:jpeg,jpg | max:1000',
            'tags'=>'required',
            'category'=>'required'
        ]);
        
        if($validator->fails()){
            return response()->json([
                 'message'=>$validator->messages()
            ]);
        }
        else{
            $data=New Post;
            $data->title=$request->title;
            $data->detail=$request->detail;
            $data->category_id=$request->category;
            $data->tags=$request->tags;
            $data->user_id=$request->session()->get('user')['id'];
            $data->views=0;
            $data->status=1;



            if($request->hasFile('thumb')){
                $destination='public/images/post/thumb';
                $name=time().'.'.$request->file('thumb')->extension();
                $request->file('thumb')->storeAs(
                    $destination,$name
                );
                $data->thumbnail=$name;
            }
            if($request->hasFile('fullimg')){
                $destination='public/images/post/fullimg';
                $name=time().'.'.$request->file('fullimg')->extension();
                $request->file('fullimg')->storeAs(
                    $destination,$name
                );
                $data->full_image=$name;
            }
            $save=$data->save();
            if($save){
                return response()->json([
                    'message'=>'success'
                ]);
            }
            else{
                return response()->json([
                    'message'=>'failure'
                ]);
            }
        }
    }

}
