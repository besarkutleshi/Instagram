@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach($posts as $post)
                <div class="col-sm-4 mb-4">
                    <a href="/p/{{$post->id}}"><img src="/storage/{{$post->image}}" class="w-100" alt=""></a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
