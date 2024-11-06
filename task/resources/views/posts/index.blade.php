@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Blog Posts</h1>

    {{-- If the user is an admin, show the "Create New Post" button --}}
    @if(Auth::check() && Auth::user()->role === 'Admin')
        <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">Create New Post</a>
    @endif

    {{-- Display the list of posts --}}
    @foreach($posts as $post)
        <div class="card mb-3">
            <div class="card-body">
                <h2 class="card-title">{{ $post->title }}</h2>
                <p class="card-text">{{ \Illuminate\Support\Str::limit($post->content, 150, '...') }}</p>
                <p class="card-text"><small class="text-muted">Posted on {{ $post->created_at->format('F j, Y') }}</small></p>

                {{-- Link to view the full post --}}
                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-info">Read More</a>

                {{-- If the user is an admin, show edit and delete buttons --}}
                @if(Auth::check() && Auth::user()->role === 'Admin')
                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">Edit</a>

                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                    </form>
                @endif
            </div>
        </div>
    @endforeach

    {{-- If there are no posts, show a message --}}
    @if($posts->isEmpty())
        <p>No posts available.</p>
    @endif
</div>
@endsection
