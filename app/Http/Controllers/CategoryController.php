<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Category::all();
        return view('admin.categorylist',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.addcategory');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'title'=>'required | max:20',
            'detail'=>'required  | max:200',
            'image'=>'required | image | mimes:jpeg,jpg | max:1000'
        ]);
        
        if($validator->fails()){
            return response()->json([
                 'message'=>$validator->messages()
            ]);
        }
        else{
            $data=New Category;
            $data->title=$request->title;
            $data->detail=$request->detail;
            if($request->hasFile('image')){
                $destination='public/images';
                $name=time().'.'.$request->file('image')->extension();
                $request->file('image')->storeAs(
                    $destination,$name
                );
                $data->image=$name;
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data=Category::find($id);
        return view('admin.editcategory',['data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $validator=Validator::make($request->all(),[
            'title'=>'required | max:20',
            'detail'=>'required  | max:200',
        ]);
        if($validator->fails()){
            return response()->json([
                'message'=>$validator->messages()
            ]);
        }
        else{
        $data=Category::find($id);
        $data->title=$request->title;
        $data->detail=$request->detail;
        if($request->hasFile('image')){
            $validator=Validator::make($request->all(),[
                'image'=>'required | mimes:jpg,jpeg | max:1000',
            ]);
            if($validator->fails()){
                return response()->json([
                    'message'=>$validator->messages()
                ]);
            }
            else{
            $destination='./public/images/';
            $filepath='./storage/images/'.$data->image;
            $name=time().'.'.$request->file('image')->extension();
            if(File::exists($filepath)){
                File::delete($filepath);
            }
            $request->file('image')->storeAs(
                $destination,$name
            );
            $data->image=$name;
            }
        }
        $updateFile=$data->save();
        if($updateFile){
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userdata=Category::find($id);
      
        if(File::exists('./storage/images/'.$userdata->image)){
            File::delete('./storage/images/'.$userdata->image);
            $deletefile=$userdata->delete();
            if($deletefile){
                return response()->json([
                    'message'=>'success'
                ]);
            }
            else{
                return response()->json([
                    'message'=>'error'
                ]);
            }
        }
        else{
            return response()->json([
                'message'=>'File not exists'
            ]);
        }
    }
}
