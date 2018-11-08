<?php

namespace App\Http\Controllers\Api;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Resources\HomeResource;
use App\Http\Resources\EditPostResource;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return HomeResource::collection(Post::orderBy('id', 'desc')->paginate(5));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'user_id' => 'required',
            'image' => 'nullable',
            'video' => 'nullable|string',
        ]);
        $data = $request->all();
        $post = new Post;

        if (strlen($data['image']) != 0)
        {
            $data['image'] = $post->uploadMainImage($data['image']);
        }
        $post->fill($data);
        $post->save();
        return $post;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new PostResource(Post::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return new EditPostResource(Post::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable',
            'video' => 'nullable|string',
        ]);

        $post = Post::findOrFail($id);
        $data = [
            'title' => $request->get('title'),
            'content' => $request->get('content'),
            'image' => $request->get('image'),
            'video' => $request->get('video')
        ];

        if (!Post::isJSON($data['image']))
        {
            $data['image'] = $post->uploadMainImage($data['image']);
        }
        $post->fill($data);
        $post->save();
        return $post;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->remove();
        return '';
    }
    public function makeLike($postId)
    {
        $post = Post::findOrFail($postId);

        if($post->likes == null) {
            $post->likes()->attach(Auth::user()->id, [
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
          ]);
        }
        elseif(!$post->likes->contains('user_id', Auth::user()->id)) {
            $post->likes()->attach(Auth::user()->id, [
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
          ]);
        }

        return response()->json(['post_liked' => true], 201 );
    }
    public function deleteLike($postId)
    {
        $post = Post::findOrFail($postId);
        $post->likes()->detach(Auth::user()->id);
        return response(null, 204);
    }
}
