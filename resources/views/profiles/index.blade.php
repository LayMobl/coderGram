@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            <img src="https://instagram.fbru2-1.fna.fbcdn.net/vp/b0c5bb9cdb6cec7323f93c720f746f2d/5D8CE438/t51.2885-19/s150x150/22709172_932712323559405_7810049005848625152_n.jpg?_nc_ht=instagram.fbru2-1.fna.fbcdn.net" class="rounded-circle">
        </div>
        <div class="col-9 p-5">
            <div class="d-flex justify-content-between align-items-baseline">
                <h1>{{$user->username}}</h1>
                <a href="{{url('p/create')}}">Add new post</a>
            </div>
            <div class="d-flex">
                <div class="pr-5"><strong>{{count($user->posts)}}</strong> posts</div>
                <div class="pr-5"><strong>23k</strong> followers</div>
                <div class="pr-5"><strong>212</strong> following</div>
            </div>
            <div class="pt-4 font-weight-bold">{{$user->profile->title}}</div>
            <div>{{$user->profile->description}}</div>
            <div><a href="{{$user->profile->url}}" target="_blank">{{$user->profile->url}}</a></div>
        </div>
    </div>
    <div class="row pt-5">
        @foreach($user->posts as $post)
        <div class="col-4 pb-4">
            <a href="{{url('/p/'. $post->id)}}">
                <img src="{{asset('/storage/'.$post->imageSmall)}}" class="w-100">
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection
