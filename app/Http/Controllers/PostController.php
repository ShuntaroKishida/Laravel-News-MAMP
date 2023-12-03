<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('post.index', compact('posts'));
    }

    public function create()
    {
        return view('post.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:30',
            'body' => 'required',
        ]);
        $post = Post::create($validated);
        return back();
    }

    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }
}
