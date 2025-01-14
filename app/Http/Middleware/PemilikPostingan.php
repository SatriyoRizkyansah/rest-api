<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PemilikPostingan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
{
    $currentUser = Auth::user();
    $post = Post::find($request->id);

    if (!$post) {
        return response()->json(['message' => 'Post not found'], 404);
    }

    if ($post->author_id != $currentUser->id) {
        return response()->json(['message' => 'Not Found'], 404);
    }

    return $next($request);
}

}
