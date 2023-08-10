<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Image;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(Request $request){
        // Store post
        if($request->isMethod('post')){
            // validations
            $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status'=>'in:0,1',
            'posted_by'=>'string|required',
            ]);
        
            $file_name = time() . '.' . request()->image->getClientOriginalExtension();
            $thumbPath = public_path('/images/thumb/').$file_name;
            $thumb_img = Image::make($request->file('image')->getRealPath())->resize(250, 250);
            $thumb_img->save($thumbPath, 80);
            $request->file('image')->move(public_path('images'), $file_name);
            
            DB::table('blogs')->insert([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $file_name,
                'active'=>$request->status,
                'posted_by'=>$request->posted_by,
                'created_at'=>date('Y-m-d H:i:s',strtotime('now')),
            ]);
            return back()->with('success', 'Blog created successfully.');
        }
        $blogs = [];
        $blogs = DB::table('blogs')->where('active',1)->orderBy('id','desc')->get();
        return view('index',compact('blogs'));
    }

    public function project(Request $request){
        if($request->isMethod('post')){
            // validations
            $request->validate([
            'name' => 'required',
            'task' => 'required',
            'status'=>'in:0,1',
            ]);
         
            DB::table('projects')->insert([
                'name' => $request->name,
                'task' => $request->task,
                'status' => $request->status,
                'created_at' => date('Y-m-d H:i:s',strtotime('now')),
                'updated_at' => date('Y-m-d H:i:s',strtotime('now')),
            ]);
            return back()->with('success', 'Task Assigned successfully.');
        }
        $projects = DB::table('projects')->where('status',1)->get();
        return view('project',compact('projects'));
    }

}
