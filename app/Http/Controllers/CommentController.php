<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\CommentResource;

class CommentController extends Controller
{
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'comments_content' => 'required',
        ]);

        $request['user_id'] = auth()->user()->id;
        $comment = Comment::create($request->all());
        
        // return response()->json($comment);
        
        return new CommentResource($comment->loadMissing('commentator:id,username'));
    }

    function update(Request $request, $id)
    {
        $validated = $request->validate([
            'comments_content' => 'required',
        ]);

        $comment = Comment::findOrFail($id);
        $comment->update($request->all());
        return new CommentResource($comment->loadMissing('commentator:id,username'));
    }
    
}
