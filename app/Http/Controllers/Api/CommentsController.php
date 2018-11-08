<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\CommentsResource;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        return CommentsResource::collection(Post::findOrFail($id)->comments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, Request $request)
    {
        $user = Auth::user();
        return Post::findOrFail($id)->comment($request->all(), $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, $comment_id, Request $request)
    {
        $commentUpdate = Post::findOrFail($id)->updateComment($comment_id, $request->all());
        return response()->json($commentUpdate);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $comment_id)
    {
        Post::findOrFail($id)->deleteComment($comment_id);
        return 'deleted';
    }
}
