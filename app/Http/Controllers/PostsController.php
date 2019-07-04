<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Post;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        $data = request()->validate([
            'caption' => 'required',
            'image' => 'required|image',
        ]);

        $imageSmallPath = request('image')->store('uploads/postThumbnails', 'public');
        $imagePath = request('image')->store('uploads/postImages', 'public');
        $imageSmall = Image::make(public_path("storage/{$imageSmallPath}"))->fit(1200, 1200);
        $image = Image::make(public_path("storage/{$imagePath}"));
        $imageSmall->save(null, 50);
        $image->save(null, 70);

        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath,
            'imageSmall' => $imageSmallPath,
        ]);

        return redirect('/profile/' . auth()->user()->id);
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }
}
