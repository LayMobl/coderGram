<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Post;

/**
 * Class PostsController
 * @package App\Http\Controllers
 */
class PostsController extends Controller
{
    /**
     * PostsController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * Retourne une liste de post en fonction des users qu'on follow
     */
    public function index()
    {
        $users = auth()->user()->following()->pluck('profiles.user_id');
        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(5);

        return view('posts.index', compact('posts'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * Retourne la vue de création de post
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * Insert le nouveau post dans la DB avec enregistrement d'image
     */
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

    /**
     * @param Post $post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * Retourne la vue détaillée d'un post
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }
}
