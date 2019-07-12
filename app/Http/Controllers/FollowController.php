<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

/**
 * Class FollowController
 * @package App\Http\Controllers
 */
class FollowController extends Controller
{
    /**
     * FollowController constructor.
     * Oblige le visiteur à s'inscrire ou se connecter pour pouvoir follow
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param User $user
     * @return mixed
     * Retourne une valeur en fonction du status follow
     */
    public function store(User $user)
    {
        return auth()->user()->following()->toggle($user->profile);
    }
}
