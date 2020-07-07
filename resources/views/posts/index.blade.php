@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach($posts as $post)
            <div class="row">
                <div class="col-8">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex">
                                <a class="text-dark" style="text-decoration: none;" href="/profile/{{$post->user->id}}}">
                                    <div>
                                        <img src="{{$post->user->profile->profileimage()}}" class="rounded-circle" style="width: 40px" height="40" alt="">
                                    </div>
                                    <div class="pl-2 pt-3">
                                        <h6>{{$post->user->username}}</h6>
                                </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <a href="/p/{{$post->id}}"><img src="/storage/{{$post->image}}" width="600" class="text-center img-fluid" alt="" ></a>
                        </div>
                        <div class="card-footer">
                            <div style="height: 20px;margin-top:-10px">
                                <a href=""><span class="fa fa-heart" style="font-size: 36px;"></span></a>
                            </div>
                            <hr>
                            @if($post->caption)
                                <div class="d-flex align-items-center">
                                    <div>
                                        <img src="{{$post->user->profile->profileimage()}}"
                                             class="rounded-circle  img-fluid" style="width: 40px" height="40" alt="">
                                    </div>
                                    <div class="pl-2 pt-3 d-flex align-items-center">
                                        <h6>{{$post->caption}}</h6>
                                    </div>
                                </div>
                                <hr>
                            @endif
                                @if($post->comments->count() != 0)
                                    @foreach($post->comments()->latest()->get() as $comment)
                                        @if($counter <= 2)
                                            <div class="d-flex align-items-center">
                                                <img src="{{$comment->user->profile->profileimage()}}" class="rounded-circle"
                                                     width="40" height="40" >
                                                <a class="text-dark ml-2" href="/profile/{{$post->user->id}}">{{$comment->user->username}}</a>
                                                <p class="mt-3 ml-2">{{$comment->comment}}</p>
                                            </div>
                                            <input type="hidden" value="{{$counter++}}">
                                        @else
                                            <div class="mt-1">
                                                <a href="">Show more</a>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif

                                <form action="/c" method="post">
                                    @csrf
                                    <div class="d-flex">
                                        <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                                        <input type="hidden" name="post_id" value="{{$post->id}}">
                                        <input type="text" class="form-control" name="comment" placeholder="comment">
                                        <input type="submit" class="btn btn-primary ml-2" value="Send">
                                    </div>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
