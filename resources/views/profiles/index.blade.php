@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3 p-5">
            <img src="{{$profileimage}}" class="rounded-circle" width="200" height="200" alt="">
        </div>
        <div class="col-9 p-5">
            <div class="d-flex justify-content-between align-items-center">

                <div class="d-flex align-items-center mb-3">
                    <div class="h4">{{$user->username}}</div>
                    @if(!$isthisaccount)
                    <follow-button user-id="{{$user->id}}" follows="{{$follows}}"></follow-button>
                    @endif
                </div>
            </div>


            @can('update',$user->profile)
                <a href="/p/create">Add New Post</a>
            @endcan
            @can('update',$user->profile)
            <div class="mb-3">
                <a href="/profile/{{$user->id}}/edit">Edit Profile</a>
            </div>
            @endcan


                <div class="d-flex">
                    <div class="pr-5">
                        <strong>{{$user->posts()->count()}}</strong> posts
                    </div>
                    <div class="pr-5">
                        <a class="text-dark" data-toggle="modal" data-target="#followersmodal" href="">
                            <strong>{{$user->profile->followers->count()}}</strong>
                            followers
                        </a>
                    </div>
                    <div class="pr-5">
                        <a class="text-dark" data-toggle="modal" data-target="#followingmodal" href="">
                            <strong>{{$user->following->count()}}</strong>
                            following
                        </a>
                    </div>
                </div>
                <div class="pt-4 font-weight-bold">
                    {{$user->profile->title}}
                </div>
                <div>
                    {{$user->profile->description}}
                </div>
                <div>
                    <a href="">{{$user->profile->url}}</a>
                </div>
        </div>
    </div>
    <hr>
    <div class="row pt-5 pb-4">
        @foreach($user->posts as $post)
        <div class="col-4">
            <a href="/p/{{$post->id}}">
                <img class="w-100" src="/storage/{{$post->image}}"  class="w-100">
            </a>
        </div>
        @endforeach
    </div>

    <div class="modal fade" id="followingmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Following</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @foreach($following as $follow)
                        <div class="row justify-content-center mb-3 ">
                            <div class="card" style="width: 350px">
                                <a class="text-dark" href="/profile/{{$follow->id}}}">
                                    <div class="card-body d-flex align-items-center">
                                        <img src="{{$follow->user->profile->profileimage()}}" class="rounded-circle" height="42" width="42" alt="">
                                        <h5 class="mt-2 pl-3" >{{$follow->user->username}}</h5>
                                        <follow-button user-id="{{$follow->user->id}}" follows="{{$followsss}}"></follow-button>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="followersmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Followers</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @foreach($followers as $follow)
                        <div class="row justify-content-center">
                            <div class="card" style="width: 350px">
                                <a class="text-dark" href="/profile/{{$follow->id}}}">
                                    <div class="card-body d-flex align-items-center">
                                        <img src="{{$follow->profile->profileimage()}}" class="rounded-circle" height="42" width="42" alt="">
                                        <h5 class="mt-2 pl-3" >{{$follow->username}}</h5>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
