<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
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
}