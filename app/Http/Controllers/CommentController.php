<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    //
    public function addcomment(Request $req){
        $validator=Validator::make($req->all(),[
            'comment'=>'required | max:255 '
        ]);
        if($validator->fails()){
            return response()->json([
                'message'=>$validator->messages()
            ]);
        }
        else{
            $data=New Comment;
            $data->user_id=$req->session()->get('user')['id'];
            $data->post_id=$req->id;
            $data->comment=$req->comment;
            $newdata=$data->save();
            if($newdata){
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
