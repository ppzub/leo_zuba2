<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserPostsResource;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function posts()
    {
    	$user = User::findOrFail(Auth::user()->id);
    	return UserPostsResource::collection($user->posts()->orderBy('id', 'desc')->get());
    }
}
