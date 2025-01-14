<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostDetailResource;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all(); 
        // return response()->json(['data' => $posts]);
        return PostDetailResource::collection($posts->loadMissing('writer:id,username'));
    }

    /*
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'title' => 'required|max:225',
            'news_content' => 'required',
        ]);

        $request['author_id'] = Auth::user()->id;
        $post = Post::create($request->all());
        // return response()->json('Berhasil di akses');
        return new PostDetailResource($post->loadMissing('writer:id,username'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = Post::With('writer:id,username')->findOrFail($id);
        return New PostDetailResource($post);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {
        $validate = $request->validate([
            'title' => 'required|max:225',
            'news_content' => 'required',
        ]);

        $post = Post::findOrFail($id);
        $post->update($request->all());
        return new PostDetailResource($post->loadMissing('writer:id,username'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return new PostDetailResource($post->loadMissing('writer:id,username'));
    }
}
