<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // Store a new comment on a post
    public function store(Request $request, Post $post)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to comment.');
        }

        $request->validate([
            'content' => 'required|string|max:500',
        ]);

        Comment::create([
            'user_id' => Auth::id(),
            'post_id' => $post->id,
            'content' => $request->content,
        ]);

        return redirect()->route('posts.show', $post)->with('success', 'Comment added successfully.');
    }
}
