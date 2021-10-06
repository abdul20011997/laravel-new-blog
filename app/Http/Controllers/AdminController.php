<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //
    public function index(){
        $Usercount=User::count();
        $Catgeorycount=Category::count();
        $Commentcount=Comment::count();
        $Postcount=Post::count();
        $data=Post::orderBy('id','DESC')->get();
        return view('admin.index',['Usercount'=>$Usercount,'Catgeorycount'=>$Catgeorycount,'Commentcount'=>$Commentcount,'Postcount'=>$Postcount,'data'=>$data]);
    }
    public function getusers(){
        $data=User::all();
        return view('admin.allusers',['data'=>$data]);
    }
    public function getcomments(){
        $data=Comment::all();
        return view('admin.allcomments',['data'=>$data]);
    }
    public function register(Request $req){
  
        $validator=Validator::make($req->all(),[
            'name'=>'required | max : 26',
            'email'=>'required | email',
            'password'=>'required',
            'cpsw'=>'required'

        ]);
        if($validator->fails()){
            return response()->json([
                'message'=>$validator->messages()
            ]);
        }
        else{
            if($req->password!=$req->cpsw){
                return response()->json([
                    'message'=>'password does not match'
                ]); 
            }
            $count=User::where('email','=',$req->email)->count();
            if($count > 0){
                return response()->json([
                    'message'=>'User already exists!!!'
                ]);
            }
            else{
                $data=New User;
                $data->name=$req->name;
                $data->email=$req->email;
                $data->password=Hash::make($req->password);
                $data->save();
                return response()->json([
                    'message'=>'success'
                ]);
                
            }
           
        }


    }

    public function login(Request $req){
        $validator=Validator::make($req->all(),[
            'email' => 'required | email',
            'password' =>'required'
        ]);
        if($validator->fails()){
            return response()->json([
                'message'=>$validator->messages()
            ]);

        }
        else{  
        $email=$req->email;
        $password=$req->password;
        $usercount=User::where('email','=',$email);
        if($usercount->count() > 0){
            $userdata=$usercount->first();
            if(Hash::check($password, $userdata->password)){
                $req->session()->put('user',$userdata);
                return response()->json([
                    'message'=>'success'
                ]);
            }
            else{
                return response()->json([
                    'message'=>'Incorrect Password'
                ]); 
            }
        }
        else{
            return response()->json([
                'message'=>'User not exists!!!'
            ]);
        }
        }


    }
}
