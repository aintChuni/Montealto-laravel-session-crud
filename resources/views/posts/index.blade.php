@extends('layouts.app')

@section('title', 'All Posts')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">All Posts</h1>
    <a href="{{ route('posts.create') }}" class="btn btn-primary">Create New Post</a>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if (empty($posts))
    <div class="alert alert-info">No posts found.</div>
@else
    <div class="list-group">
        @foreach ($posts as $post)
            <div class="list-group-item">
                <h5 class="mb-1">{{ $post['title'] }}</h5>
                <p class="mb-1">{{ $post['content'] }}</p>
                <div class="d-flex justify-content-between">
                    <a href="{{ route('posts.edit', $post['id']) }}" class="btn btn-sm btn-warning">Edit</a>

                    <form method="POST" action="{{ route('posts.destroy', $post['id']) }}" onsubmit="return confirm('Are you sure you want to delete this post?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection
