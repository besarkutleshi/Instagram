<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use Illuminate\Http\Request;
use App\Post;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $user = auth()->user()->following()->pluck('profiles.user_id');
        $posts = Post::whereIn('user_id',$user)->with('user')->latest()->get();



        return view('posts.index',compact('posts'));
    }


    public function create(){
        return view('posts.create');
    }

    public function store(Request $request){
        $data = $request->validate([
            'caption' => 'required',
            'image' => ['required','image']
        ]);

        $imagepath = request('image')->store('uploads','public');
        $image = Image::make(public_path("storage/{$imagepath}"))->fit(1200,1200);
        $image->save();

        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagepath,
        ]);

        return redirect('/profile/'.auth()->user()->id);
    }

    public function show(\App\Post $post){
        return view('posts.show',compact('post'));
    }
}
