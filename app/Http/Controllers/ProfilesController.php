<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;
use App\User;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    public function __construct()
    {
    }

    public function index(User $user)
    {
        $profileimage = $user->profile->profileimage();
        //dd($profileimage);
        $isthisaccount = false;
        if(auth()->user()){
            if($user->id == auth()->user()->id){
                $isthisaccount = true;
            }
        }
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;

        $followers = $user->profile->followers()->get();
        $following = $user->following()->get();
        //dd($following->profileimage());
        $followsss = true;
        return view('profiles.index',
            compact('user','follows','profileimage','followers','followsss','following','isthisaccount'));
    }

    public function edit(User $user){
        $this->authorize('update',$user->profile);
        return view('profiles.edit',compact('user'));
    }

    public function update(User $user){

        $this->authorize('update',$user->profile);
        $data = request()->validate([
           'title' => 'required',
            'description' => 'required',
            'url' => 'url'
        ]);

        if(request('image')){
            $imagepath = request('image')->store('profile','public');
            $image = Image::make(public_path("storage/{$imagepath}"))->fit(1000,1000);
            $image->save();
            $imageArray = ['image'=>$imagepath];
        }

        auth()->user()->profile->update(array_merge(
            $data,
            $imageArray ?? []
        ));

        return redirect("/profile/{$user->id}");
    }

    public function search($words){
        $users = User::where('username', 'like', $words.'%')
            ->orWhere('name', 'like', '% '.$words.'%')
            ->get();
        //foreach ($users as $user) {
        //   dd($user->profile->profileimage());
        //}
        return $users;
    }

    public function image(User $user){
        return $user->profile->profileimage();
    }
}
