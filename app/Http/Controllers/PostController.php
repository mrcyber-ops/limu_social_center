<?php
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $posts = Post::with('user', 'likes')->orderBy('created_at', 'desc')->get();
        return view('users.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view('users.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $this->validate($request, [
            'content' => ['required', 'string', 'min:3', 'max:1000']
        ]);

        Post::create([
            'content' => $request->content,
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post) {
        $post->load('comments.user'); // Load comments and their associated users
        return view('users.posts.show', compact('post'));
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post) {
        return view('users.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post) {
        $this->validate($request, [
            'content' => ['required', 'string', 'min:3', 'max:1000']
        ]);

        $post->update([
            'content' => $request->content,
        ]);

        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post) {
        $post->delete();
        return redirect()->back();
    }
}
