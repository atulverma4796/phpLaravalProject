<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
    }
    public function index(){
        $posts=Post::paginate(20);
        return view('posts.index',[
            'posts'=> $posts,
        ]);
    }
    public function store(Request $request){
      $this->validate($request,[
          'body'=>'required'
      ]);
    //   Post::create([
    //       'user_id'=>auth()->user()->id,
    //       'body'=>$request->body
    //   ]);
        $request->user()->posts()->create([
            'body'=>$request->body,
        ]);
        return back();
    }
}