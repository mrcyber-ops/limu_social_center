<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post) {
        $this->validate($request, [
            'content' => ['required', 'string', 'min:3', 'max:1000']
        ]);

        Comment::create([
            'content' => $request->content,
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
        ]);

        return redirect()->back();
    }
}
