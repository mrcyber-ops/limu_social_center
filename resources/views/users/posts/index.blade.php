@extends('layouts.app')

@section('content')
<div class="container bg-white p-3">
    <div class="row">
        <!-- Text area for new post -->
        <div class="col">
            <form action="{{ route('posts.store') }}" method="POST">
                @csrf
                @method('POST')
                <div class="form-floating">
                    <textarea class="form-control @error('content') border border-danger @enderror" name="content" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                    @error('content')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <label for="floatingTextarea2">Whats on your mind?</label>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Post</button>
            </form>
        </div>
        
        <!-- Feed -->
        <div class="col">
            @if ($posts->count() == 0)
                <div class="p-3 text-white bg-secondary rounded border">
                    There are no posts yet!
                </div>
            @endif

            @if($posts->count() > 0)
                @foreach ($posts as $post)
                    <div class="card my-3">
                        <div class="card-header">
                            {{ $post->user->name }}
                        </div>
                        <div class="card-body">
                            <blockquote class="blockquote mb-0">
                                <p>{{ $post->content }}</p>
                            </blockquote>

                            <hr>

                            <form action="{{ route('posts.likes', ['post' => $post, 'user' => auth()->user()->id]) }}" method="POST">
                                @csrf
                                @method('POST')
                                <button class="btn btn-outline-primary btn-sm">Like <span class="badge text-bg-primary">{{ $post->likes->count() }}</span></button>
                            </form>

                            <!-- Edit and Delete Buttons -->
                            <div class="mt-3">
                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-secondary btn-sm">Edit</a>
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>

                            <!-- Comments Section -->
                            <div class="mt-3">
                                <h5>Comments</h5>
                                @foreach ($post->comments as $comment)
                                    <div class="card mt-2">
                                        <div class="card-body">
                                            <h6>{{ $comment->user->name }}</h6>
                                            <p>{{ $comment->content }}</p>
                                        </div>
                                    </div>
                                @endforeach

                                <!-- Add Comment Form -->
                                <form action="{{ route('comments.store', $post->id) }}" method="POST" class="mt-2">
                                    @csrf
                                    <div class="form-group">
                                        <textarea class="form-control @error('content') border border-danger @enderror" name="content" placeholder="Add a comment" rows="2" required></textarea>
                                        @error('content')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm mt-2">Comment</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection
