@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach($followers as $follow)
            <div class="row justify-content-center mb-3 ">
                <div class="card" style="width: 350px">
                    <a class="text-dark" href="/profile/{{$follow->user->id}}}">
                        <div class="card-body d-flex align-items-center">
                            <img src="{{$follow->user->profile->profileimage()}}" class="rounded-circle" height="42" width="42" alt="">
                            <h5 class="mt-2 pl-3" >{{$follow->user->username}}</h5>
                            <follow-button user-id="{{$follow->user->id}}" follows="{{$follows}}"></follow-button>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
