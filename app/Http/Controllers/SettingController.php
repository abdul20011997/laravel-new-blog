<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    //
    public function index(){
        $data=Setting::all();
        return view('admin.settings',['title'=>'Settings','data'=>$data]);
    }
    public function addsettings(Request $req){
        $count=Setting::count();
        if($count > 0){
            $data1=Setting::first();
            $data=Setting::find($data1->id);
            $data->comment_auto=$req->comment_auto;
            $data->user_auto=$req->user_auto;
            $data->recent_limit=$req->recent_limit;
            $data->popular_limit=$req->popular_limit;
            $data->recent_comment_limit=$req->recent_comment_limit;
            $savesetting=$data->save();
            if($savesetting){
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
         $data=New Setting;
         $data->comment_auto=$req->comment_auto;
         $data->user_auto=$req->user_auto;
         $data->recent_limit=$req->recent_limit;
         $data->popular_limit=$req->popular_limit;
         $data->recent_comment_limit=$req->recent_comment_limit;
         $savesetting=$data->save();
         if($savesetting){
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


    }
}
