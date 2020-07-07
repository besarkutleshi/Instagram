<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];

    public function profileimage(){
        $image = $this->image ? $this->image : '//profile/5ZlreksrH7cGJpb9GXmBHgZRbCR5WydaxeLuUWTp.png';
        return  '/storage/'.$image;
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function followers(){
        return $this->belongsToMany(User::class);
    }

}
