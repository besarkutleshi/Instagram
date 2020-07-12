@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <img src="/storage/{{$post->image}}" alt="" class="img-fluid">
                <div class="mt-1">
                    <like id="likeid{{$post->id}}" userid="{{auth()->user()->id}}" postid="{{$post->id}}"
                          likes="{{$post->likes->count()}}"></like>
                    <div class="d-flex mt-1">
                        <p id="likes{{$post->id}}">{{$post->likes->count()}}</p>
                        <likes postid="{{$post->id}}" ></likes>
                    </div>
                </div>
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
                            <div id="{{$post->id}}">
                                @if($post->comments->count() != 0)
                                    @foreach($post->comments()->latest()->get() as $comment)
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
