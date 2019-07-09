@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            <img src="{{asset($user->profile->profileImage())}}" class="rounded-circle w-100">
        </div>
        <div class="col-9 p-5">
            <div class="d-flex justify-content-between align-items-baseline">
                <div class="d-flex align-items-center pb-3">
                    <div class="h4">{{$user->username}}</div>
                    <button class="btn btn-primary ml-4">Follow</button>
                </div>

                @can('update', $user->profile)
                    <a href="{{url('p/create')}}">Add new post</a>
                @endcan
            </div>
            @can('update', $user->profile)
                <a href="{{url('profile/'.$user->id.'/edit')}}">Edit profile</a>
            @endcan
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
