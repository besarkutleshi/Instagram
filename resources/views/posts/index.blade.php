@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach($posts as $post)
            <div class="row">
                <div class="col-8 mb-4">
                    <div class="card">
                        <div class="card-header bg-white">
                            <div class="d-flex align-items-baseline">
                                <a class="text-dark" style="text-decoration: none;" href="/profile/{{$post->user->id}}}">
                                    <div>
                                        <img src="{{$post->user->profile->profileimage()}}" class="rounded-circle" style="width: 40px" height="40" alt="">
                                    </div>
                                </a>
                                <div class="pl-2 pt-3">
                                    <a class="text-dark" href="/profile/{{$post->user->id}}"><h6>{{$post->user->username}}</h6></a>
                                </div>
                            </div>
                        </div>
                    <div class="card-body">
                        <a href="/p/{{$post->id}}"><img src="/storage/{{$post->image}}" width="600" class="text-center img-fluid" alt="" ></a>
                    </div>
                    <div class="card-footer bg-white">
                        <div style="margin-top:-10px">
                            <like id="likeid{{$post->id}}" userid="{{auth()->user()->id}}" postid="{{$post->id}}"
                                  likes="{{$post->likes->count()}}"></like>
                            <div class="d-flex">
                                <p id="likes{{$post->id}}">{{$post->likes->count()}}</p>
                                <likes postid="{{$post->id}}"></likes>
                            </div>
                        </div>
                        @if($post->caption)
                            <div class="d-flex align-items-baseline" style="margin-top: -10px">
                                <a class="text-dark" href="/profile/{{$post->user->id}}"><p>{{$post->user->username}}</p></a>
                                <h6 class="ml-2" style="margin-top: 0px">{{$post->caption}}</h6>
                            </div>
                            <hr style="margin-top: -10px">
                        @endif
                        <div id="{{$post->id}}">
                            @if($post->comments->count() != 0)
                                @foreach($post->comments()->latest()->get() as $comment)
                                    @if($counter <= 2)
                                        <div id="commentcard{{$post->id}}" class="card-body" style="margin-top: -30px">
                                            <div class="d-flex align-items-center">
                                                <img src="{{$comment->user->profile->profileimage()}}" class="rounded-circle"
                                                     width="40" height="40" >
                                                <a class="text-dark ml-2" href="/profile/{{$post->user->id}}">{{$comment->user->username}}</a>
                                                <p class="mt-3 ml-2">{{$comment->comment}}</p>
                                                @if($comment->user->id == auth()->user()->id || $comment->post->user->id == auth()->user()->id)
                                                    <delete-comment commentid="{{$comment->id}}" postid="{{$post->id}}"></delete-comment>
                                                @endif
                                            </div>
                                            <input type="hidden" value="{{$counter++}}">
                                        </div>
                                    @endif
                                @endforeach
                                @if($counter >= 3)
                                        <div class="mt-1">
                                            <a href="">Show more</a>
                                        </div>
                                    @endif
                                    <input type="hidden" value="{{$counter=0}}">
                            @endif
                        </div>
                        <create-comment exist="{{$post->comments->count()}}"
                                        userid="{{auth()->user()->id}}"
                                        postid="{{$post->id}}"
                                        username="{{auth()->user()->username}}">
                        </create-comment>
                    </div>
                    </div>
                </div>
            </div>
        @endforeach
            <div class="modal fade" id="likesmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Likes</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row justify-content-center">
                                <div id="likescard" class="card" style="width: 350px">

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection
