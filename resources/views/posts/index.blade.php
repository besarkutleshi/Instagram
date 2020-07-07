@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach($posts as $post)
            <div class="row">
                <div class="col-8">
                    <div class="card">
                        <div class="card-header bg-white">
                            <div class="d-flex">
                                <a class="text-dark" style="text-decoration: none;" href="/profile/{{$post->user->id}}}">
                                    <div>
                                        <img src="{{$post->user->profile->profileimage()}}" class="rounded-circle" style="width: 40px" height="40" alt="">
                                    </div>
                                </a>
                                <div class="pl-2 pt-3">
                                    <h6>{{$post->user->username}}</h6>
                                </div>
                            </div>
                        </div>
                    <div class="card-body">
                        <a href="/p/{{$post->id}}"><img src="/storage/{{$post->image}}" width="600" class="text-center img-fluid" alt="" ></a>
                    </div>
                    <div class="card-footer bg-white">
                        <div style="margin-top:-10px">
                            <a href=""><span class="fa fa-heart" style="font-size:28px;"></span></a>
                            <p>125 <span>likes</span></p>
                        </div>
                        @if($post->caption)
                            <div class="d-flex align-items-baseline" style="margin-top: -10px">
                                <p>{{$post->user->username}}</p>
                                <h6 class="ml-2" style="margin-top: 0px" >{{$post->caption}}</h6>
                            </div>
                            <hr style="margin-top: -10px">
                        @endif
                        <div id="card">
                            @if($post->comments->count() != 0)
                                @foreach($post->comments()->latest()->get() as $comment)
                                    @if($counter <= 2)
                                        <div id="commentcard" class="card-body" style="margin-top: -30px">
                                            <div class="d-flex align-items-center">
                                                <img src="{{$comment->user->profile->profileimage()}}" class="rounded-circle"
                                                     width="40" height="40" >
                                                <a class="text-dark ml-2" href="/profile/{{$post->user->id}}">{{$comment->user->username}}</a>
                                                <p class="mt-3 ml-2">{{$comment->comment}}</p>
                                            </div>
                                            <input type="hidden" value="{{$counter++}}">
                                        </div>
                                    @else
                                        <div class="mt-1">
                                            <a href="">Show more</a>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                        <create-comment exist="{{$post->comments->count()}}" userid="{{auth()->user()->id}}" postid="{{$post->id}}" username="{{auth()->user()->username}}" ></create-comment>
                    </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
