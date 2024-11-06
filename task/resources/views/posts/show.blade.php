@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $post->title }}</h1>
    <p class="text-muted">Posted on {{ $post->created_at->format('F j, Y') }}</p>
    <div class="content mb-4">
        {{ $post->content }}
    </div>

    <!-- Comments Section -->
    <h3>Comments</h3>

    <!-- Display all comments for this post -->
    <div class="comments mb-4">
        @forelse($post->comments as $comment)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $comment->user->name }}</h5>
                    <p class="card-text">{{ $comment->content }}</p>
                    <p class="card-text"><small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small></p>
                </div>
            </div>
        @empty
            <p>No comments yet. Be the first to comment!</p>
        @endforelse
    </div>

    <!-- Add a Comment Form (only for logged-in users) -->
    @auth
        <h4>Leave a Comment</h4>
        <form action="{{ route('comments.store', $post->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="content" class="form-label">Your Comment</label>
                <textarea name="content" id="content" class="form-control" rows="4" required>{{ old('content') }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Comment</button>
        </form>
    @else
        <p><a href="{{ route('login') }}">Log in</a> to leave a comment.</p>
    @endauth

    <!-- Back to Posts link -->
    <a href="{{ route('posts.index') }}" class="btn btn-secondary mt-4">Back to Posts</a>
</div>
@endsection
