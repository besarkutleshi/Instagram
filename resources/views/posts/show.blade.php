@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8">
                <img src="/storage/{{$post->image}}" alt="" class="w-100">
            </div>
            <div class="col-4">
                <div class="d-flex">
                    <div>
                        <img src="{{$post->user->profile->profileimage()}}" class="rounded-circle" style="width: 70px" height="70" alt="">
                    </div>
                    <div class="pl-2 pt-4">
                        <h6>{{$post->user->username}}</h6>
                    </div>
                </div>
                <hr>
                <div class="card mt-5">
                    <div class="card-body">
                        @if($post->caption)
                            <div class="d-flex">
                                <div>
                                    <img src="{{$post->user->profile->profileimage()}}" class="rounded-circle" style="width: 40px" height="40" alt="">
                                </div>
                                <div class="pl-2 pt-3">
                                    <h6>{{$post->caption}}</h6>
                                </div>
                            </div>
                            <hr>
                        @endif
                            @if($post->comments->count() != 0)
                                @foreach($post->comments()->get() as $comment)
                                    <div class="">
                                        <div class="d-flex align-items-center">
                                            <img src="{{$comment->user->profile->profileimage()}}" class="rounded-circle"
                                                 width="40" height="40" >
                                            <a href="/profile/{{$comment->user->id}}" class="text-dark"><p class="mt-3 ml-2">{{$comment->user->username}}</p></a>
                                            <p class="mt-3 ml-2">{{$comment->comment}}</p>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                    </div>
                    <div class="card-footer">
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
    </div>
@endsection
