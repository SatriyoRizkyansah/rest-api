<?php

namespace App\Http\Controllers;

use App\Models\Post;

abstract class Controller
{
    public function index(){
        $posts = Post::all(); 
        return response()->json(['data' => $posts]);
        // return PostDetailResource::collection($posts->with('writer:id,username'));
        // return PostDetailResource::collection($posts->loadMissing(['author:id,username','comments:id,post_id,user_id,comments_content']));
    }
}
