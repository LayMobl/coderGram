<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

/**
 * Class ProfilesController
 * @package App\Http\Controllers
 */
class ProfilesController extends Controller
{
    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * Retourne la liste des posts d'un user en utilisant le cache
     */
    public function index(User $user)
    {
        $follow = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;

//        Petit exercice de cache
        $postCount = Cache::remember('count.posts' . $user->id, now()->addSecond(30), function () use ($user) {
            return count($user->posts);
        });
        $followersCount = Cache::remember('count.followers' . $user->id, now()->addSecond(30), function () use ($user) {
            return count($user->profile->followers);
        });
        $followingCount = Cache::remember('count.following' . $user->id, now()->addSecond(30), function () use ($user) {
            return count($user->following);
        });
        return view('profiles.index', compact('user', 'follow', 'postCount', 'followersCount', 'followingCount'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * Retourne une liste de 5 utilisateurs qui ne follow pas le user connecté
     */
    public function list()
    {
        $followers = auth()->user()->following()->pluck('profiles.user_id')->each(function ($item, $key) {
            return $item;
        })->toArray();
        $users = User::all()->whereNotIn('id', $followers)->take(10);
        return view('profiles.list', compact('users'));
    }


    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * Retourne la vue d'édition du profile en fonction de l'autorisation
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user->profile);

        return view('profiles.edit', compact('user'));
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * Update des modifictions apportées au user
     */
    public function update(User $user)
    {
        $this->authorize('update', $user->profile);

        $data = request()->validate([
         'title' => 'required',
         'description' => 'required',
         'url' => 'url',
         'image' => '',
        ]);

        if (request('image')) {
            $imagePath = request('image')->store('uploads/profile', 'public');
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);

            $image->save(null, 70);
            $imageArray = ['image' => $imagePath];
        }

        auth()->user()->profile->update(array_merge(
            $data,
            $imageArray ?? []
        ));

        return redirect("/profile/{$user->id}");
    }
}
