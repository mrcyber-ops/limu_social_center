@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $post->user->name }}'s Post</h1>
    <p>{{ $post->content }}</p>

    <hr>

    <h2>Comments</h2>
    @foreach($post->comments as $comment)
        <div class="card my-3">
            <div class="card-header">
                {{ $comment->user->name }}
            </div>
            <div class="card-body">
                <p>{{ $comment->content }}</p>
            </div>
        </div>
    @endforeach

    <hr>

    <h2>Add a Comment</h2>
    <form action="{{ route('comments.store', $post->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="content">Content</label>
            <textarea class="form-control @error('content') border border-danger @enderror" id="content" name="content" rows="3" required></textarea>
            @error('content')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
