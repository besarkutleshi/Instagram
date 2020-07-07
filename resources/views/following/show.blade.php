@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach($following as $follow)
            <div class="row justify-content-center mb-3 ">
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
@endsection
