@extends('layouts.app')

@section('content')
<div class="container">
    @inject('users', '\App\Http\Controllers\ProfilesController')
    {!! $users->list() !!}
    @if(empty($posts))
        <h1 class="py-5 text-center">No recent posts from the people you follow :(</h1>
    @else
        <h1 class="py-5 text-center">Latest posts from the people you follow:</h1>
        @foreach($posts as $post)
            <div class="row p">
                <div class="col-6 offset-3">
                    <a href="{{url('/profile/'. $post->user->id)}}">
                        <img src="{{ asset('/storage/' . $post->imageSmall) }}" class="img-fluid">
                    </a>
                </div>
            </div>
            <div class="row pt-2 pb-4">
                <div class="col-6 offset-3">
                    <div>
                        <p>
                            <span class="font-weight-bold">
                                <a href="{{url('/profile/'. $post->user->id)}}">
                                    <span class="text-dark">{{ $post->user->username }}</span>
                                </a>
                            </span>
                                - {{ $post->caption }}
                            </p>
                        </div>
                    </div>
                </div>
        @endforeach
        <div class="row col-12 d-flex justify-content-center">
            {{$posts->links()}}
        </div>
    @endif
</div>
@endsection
