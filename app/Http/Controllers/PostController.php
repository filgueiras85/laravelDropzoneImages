<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Gate;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('posts.index',compact('posts'));
    }
    public function show(Post $post)
    {
        return view('posts.show',compact('post'));
    }
    public function upload(Request $request , Post $post){
        if (Gate::denies('upload_image', $post)){
            abort(401);
        }
        if ($request->hasFile('file')){
            $file = $request->file('file');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public\images' , $fileName);
            if ($path){
                $post->images()->create([
                   'path' => $fileName
                ]);
                return response()->json(['upload_status' => 'success'] , 200);
            }else{
                return response()->json(['upload_status' => 'error'] , 401);
            }
        }else{
            return response()->json(['upload_status' => 'no file'] , 401);
        }
    }
}
