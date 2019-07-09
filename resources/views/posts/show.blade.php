@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8">
            <img src="{{ asset('/storage/' . $post->image) }}" class="img-fluid">
        </div>
        <div class="col-4">
            <div>
                <div class="d-flex align-items-center">
                    <div class="pr-3">
                        <img src="{{asset($post->user->profile->profileImage())}}" alt="" class="rounded-circle w-100" style="max-width: 40px">
                    </div>
                    <div>
                        <div class="font-weight-bold">
                            <a href="{{url('/profile/'. $post->user->id)}}">
                                <span class="text-dark">{{ $post->user->username }}</span>
                            </a>
                            <span>&middot;</span>
                            <a href="#">Follow</a>
                        </div>
                    </div>
                </div>
                <hr>
                <p>
                    <span class="font-weight-bold">
                        <a href="{{url('/profile/'. $post->user->id)}}">
                            <span class="text-dark">{{ $post->user->username }}</span>
                        </a>
                    </span>
                    {{ $post->caption }}
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
