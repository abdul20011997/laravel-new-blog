<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\File;
class PostController extends Controller
{
    public function index(){
        $data=Post::all();
        $data2=Category::all();
        return view('admin.postlist',['title'=>'Post List','data'=>$data,'data2'=>$data2]);
    }

    public function create(){
        $data=Category::all();
        return view('admin.addpost',['title'=>'Add Post','data'=>$data]);
    }
    public function addpost(Request $request){
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
            $data->user_id=0;
            $data->views=0;


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

    public function deletepost($id){
        $data=Post::find($id);
        $fullimgdestination='./storage/images/post/fullimg/'.$data->full_image;
        $thumbnaildestination='./storage/images/post/thumb/'.$data->thumbnail;

        if(File::exists($fullimgdestination) && File::exists($thumbnaildestination)){
            File::delete($fullimgdestination);
            File::delete($thumbnaildestination);
            $postdelete=$data->delete();
            if($postdelete){
                return response()->json([
                    'message'=>'success'
                ]);
            }
            else{
                return response()->json([
                    'message'=>'Something went wrong'
                ]);
            }
        }
        else{
            return response()->json([
                'message'=>'Post Deleted Successfully'
            ]);
        }
    }
    public function editpost($id){
        $data1=Post::find($id);
        $data=Category::all();
        return view('admin.editpost',['title'=>'Edit Post','data'=>$data,'data1'=>$data1]);
    }
    public function updatepost(Request $request){
        $validator=Validator::make($request->all(),[
            'title'=>'required | max:20',
            'detail'=>'required  | max:200',
            'tags'=>'required',
            'category'=>'required'
        ]);
        if($validator->fails()){
            return response()->json([
                'message'=>$validator->messages()
            ]);
        }
        else{
            $data=Post::find($request->id);
            $data->title=$request->title;
            $data->detail=$request->detail;
            $data->tags=$request->tags;
            $data->category_id=$request->category;
            if($request->hasFile('thumb')){
                $validator=Validator::make($request->all(),[
                    'thumb'=>'required | image | mimes:jpeg,jpg | max:1000'
                ]);
                if($validator->fails()){
                    return response()->json([
                        'message'=>$validator->messages()
                    ]);
                }
                else{
                    $destination='./storage/images/post/thumb/'.$data->thumbnail;
                    if(File::exists($destination)){
                        File::delete($destination);
                    }
                    $newdestination='./public/images/post/thumb/';
                    $name=time().'.'.$request->file('thumb')->extension();
                    $request->file('thumb')->storeAs($newdestination,$name);
                    $data->thumbnail=$name;
                }
            }

            if($request->hasFile('fullimg')){
                $validator=Validator::make($request->all(),[
                    'fullimg'=>'required | image | mimes:jpeg,jpg | max:1000'
                ]);
                if($validator->fails()){
                    return response()->json([
                        'message'=>$validator->messages()
                    ]);
                }
                else{
                    $destination='./storage/images/post/fullimg/'.$data->full_image;
                    if(File::exists($destination)){
                        File::delete($destination);
                    }
                    $newdestination='./public/images/post/fullimg/';
                    $name=time().'.'.$request->file('fullimg')->extension();
                    $request->file('fullimg')->storeAs($newdestination,$name);
                    $data->full_image=$name;
                }
            }

            $updatedata=$data->save();
            if($updatedata){
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