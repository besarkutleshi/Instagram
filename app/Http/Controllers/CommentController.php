<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
           'user_id' => 'required',
           'post_id' => 'required',
           'comment' => 'required'
        ]);


        return Comment::create([
           'user_id' => $data['user_id'],
           'post_id' => $data['post_id'],
           'comment' => $data['comment'],
        ]);


    }

    public function destroy(Comment $comment){

        if($comment->user->id == auth()->user()->id || $comment->post->user->id == auth()->user()->id){
            DB::table('comments')->where('id', '=', $comment->id)->delete();
            return redirect("/p/{$comment->post->id}");
        }

    }

}
