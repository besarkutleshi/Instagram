<?php

namespace App\Http\Controllers;

use App\Like;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LikeController extends Controller
{

    public function store(Request $request){
        $data = $request->validate([
            'user_id' => 'required',
            'post_id' => 'required',
        ]);

        $like = DB::table('likes')->where('user_id','=',$data['user_id'])
            ->where('post_id','=',$data['post_id'])->get();

        $likeid = 0;
        foreach ($like as $item) {
            $likeid = $item->id;
            break;
        }
        if($like != null && $like->count() > 0){
            if(Like::find($likeid)->delete()){
                return "deleted";
            }
        }

        return Like::create([
            'user_id' => $data['user_id'],
            'post_id' => $data['post_id'],
        ]);

    }

    public function IsLiked($userid,$postid){
        $like = DB::table('likes')->where('user_id','=',$userid)
            ->where('post_id','=',$postid)->get();
    }

    public function GetLikes($postid){
        $likes = DB::table('likes')
            ->join('users', 'users.id', '=', 'likes.user_id')
            ->join('profiles', 'profiles.user_id', '=', 'users.id')
            ->where('post_id','=',$postid)
            ->get();
        return $likes;
    }
}
