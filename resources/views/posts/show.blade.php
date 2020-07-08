@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <img src="/storage/{{$post->image}}" alt="" class="img-fluid">
            </div>
            <div class="col-sm-6">
                <div class="d-flex mt-3">
                    <div>
                        <img src="{{$post->user->profile->profileimage()}}" class="rounded-circle" style="width: 70px" height="70" alt="">
                    </div>
                    <div class="pl-2 pt-4">
                        <h6>{{$post->user->username}}</h6>
                    </div>
                </div>
                <hr>
                <div class="card">
                    <div class="card-body">
                        @if($post->caption)
                            <div class="d-flex">
                                <div>
                                    <img src="{{$post->user->profile->profileimage()}}" class="rounded-circle img-fluid" style="width: 40px" height="40" alt="">
                                </div>
                                <div class="pl-2 pt-3">
                                    <h6>{{$post->caption}}</h6>
                                </div>
                            </div>
                            <hr>
                        @endif
                        <div id="card">
                            @if($post->comments->count() != 0)
                                @foreach($post->comments()->get() as $comment)
                                    <div id="commentcard">
                                        <div class="d-flex align-items-center">
                                            <img src="{{$comment->user->profile->profileimage()}}" class="rounded-circle"
                                                 width="40" height="40" >
                                            <a href="/profile/{{$comment->user->id}}" class="text-dark"><p class="mt-3 ml-2">{{$comment->user->username}}</p></a>
                                            <p class="mt-3 ml-2">{{$comment->comment}}</p>
                                            @if($comment->user->id == auth()->user()->id || $comment->post->user->id == auth()->user()->id)

                                                <a class="ml-2" href="/c/delete/{{$comment->id}}"><span class="fa fa-trash"></span></a>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="card-footer">
                        <create-comment exist="{{$post->comments->count()}}" userid="{{auth()->user()->id}}"
                                        postid="{{$post->id}}" username="{{auth()->user()->username}}" ></create-comment>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
