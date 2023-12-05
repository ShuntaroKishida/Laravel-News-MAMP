<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function create()
    {
        return view('posts.create');
    }
    
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|string|max:30',
            'content' => 'required|string',
        ];
        $request->validate($rules);

        $post = new Post();
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->save();
        return redirect()->route('posts.index')->with('success', '投稿が作成されました。');
    }
    public function destroy(Post $post)
    {
        $post->comments()->delete();
        $post->delete();
        return redirect()->route('posts.index')->with('success', '投稿が削除されました。');
    }
}

?>