<?php
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // Display a list of all posts
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    // Show form to create a new post (Admin only)
    public function create()
    {

        return view('posts.create');
    }

    // Store a new post in the database (Admin only)
    public function store(Request $request)
    {
        if (!Auth::check() || Auth::user()->role !== 'Admin') {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
        ]);

        Post::create([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    // Show form to edit a post (Admin only)
    public function edit(Post $post)
    {
        if (!Auth::check() || Auth::user()->role !== 'Admin') {
            abort(403, 'Unauthorized action.');
        }

        return view('posts.edit', compact('post'));
    }

    // Update an existing post in the database (Admin only)
    public function update(Request $request, Post $post)
    {
        if (!Auth::check() || Auth::user()->role !== 'Admin') {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
        ]);

        $post->update($request->all());

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    // Delete a post (Admin only)
    public function destroy(Post $post)
    {
        if (!Auth::check() || Auth::user()->role !== 'Admin') {
            abort(403, 'Unauthorized action.');
        }

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }
}
