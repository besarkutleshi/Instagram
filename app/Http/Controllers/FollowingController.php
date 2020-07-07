<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class FollowingController extends Controller
{
    public function myfollowing(User $user){
        $following = $user->profile->followers()->get();
        $users = User::whereIn('id',$following)->get();

        return view('following.show',compact('following'));
    }

    public function myfollowers(User $user){
        $followers = $user->following()->get();
        $follows = true;
        return view('following.followers',compact('followers','follows'));
    }

}
