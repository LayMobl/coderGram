@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            <img src="https://instagram.fbru2-1.fna.fbcdn.net/vp/b0c5bb9cdb6cec7323f93c720f746f2d/5D8CE438/t51.2885-19/s150x150/22709172_932712323559405_7810049005848625152_n.jpg?_nc_ht=instagram.fbru2-1.fna.fbcdn.net" class="rounded-circle">
        </div>
        <div class="col-9 p-5">
            <div><h1>{{$user->username}}</h1></div>
            <div class="d-flex">
                <div class="pr-5"><strong>153</strong> posts</div>
                <div class="pr-5"><strong>23k</strong> followers</div>
                <div class="pr-5"><strong>212</strong> following</div>
            </div>
            <div class="pt-4 font-weight-bold">{{$user->profile->title}}</div>
            <div>{{$user->profile->description}}</div>
            <div><a href="{{$user->profile->url}}" target="_blank">{{$user->profile->url}}</a></div>
        </div>
    </div>
    <div class="row pt-4">
        <div class="col-4">
            <img src="https://instagram.fbru2-1.fna.fbcdn.net/vp/348e0f10b8d9b8841683a3f624f842df/5DBD4D94/t51.2885-15/sh0.08/e35/c6.0.737.737a/s640x640/64842736_675454446259763_390781940470065216_n.jpg?_nc_ht=instagram.fbru2-1.fna.fbcdn.net" class="w-100">
        </div>
        <div class="col-4">
            <img src="https://instagram.fbru2-1.fna.fbcdn.net/vp/936982cc05c909aa5d34fc2ec2aa1347/5DAF8D71/t51.2885-15/sh0.08/e35/c4.0.741.741/s640x640/64675685_210875326548910_7731632172709143956_n.jpg?_nc_ht=instagram.fbru2-1.fna.fbcdn.net" class="w-100">
        </div>
        <div class="col-4">
            <img src="https://instagram.fbru2-1.fna.fbcdn.net/vp/35182511b48b0ab3bd67348ec3ed7e8b/5DA5B466/t51.2885-15/sh0.08/e35/c1.0.747.747/s640x640/60581454_869432733405043_458079974647968282_n.jpg?_nc_ht=instagram.fbru2-1.fna.fbcdn.net" class="w-100">
        </div>
    </div>
</div>
@endsection
