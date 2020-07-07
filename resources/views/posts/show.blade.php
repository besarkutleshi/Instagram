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
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
