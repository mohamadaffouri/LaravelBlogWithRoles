@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create New Post</h1>

    <!-- Display validation errors, if any -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Post creation form -->
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf

        <!-- Title input -->
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
        </div>

        <!-- Content input -->
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea name="content" id="content" class="form-control" rows="6" required>{{ old('content') }}</textarea>
        </div>

        <!-- Submit button -->
        <button type="submit" class="btn btn-primary">Create Post</button>
        <a href="{{ route('posts.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
