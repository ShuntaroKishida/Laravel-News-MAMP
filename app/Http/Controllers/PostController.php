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
        // バリデーションルールの設定
        $rules = [
            'title' => 'required|string|max:30',
            'content' => 'required|string',
        ];

        // バリデーションの実行
        $request->validate($rules);

        // 新しい投稿を作成して保存
        $post = new Post();
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->save();

        // 成功時のリダイレクトなどを適切に処理する
        return redirect()->route('posts.index')->with('success', '投稿が作成されました。');
    }
    public function destroy(Post $post)
    {
        // 投稿に紐づくコメントを削除
        $post->comments()->delete();

        // 投稿を削除
        $post->delete();

        // 成功時のリダイレクトなどを適切に処理する
        return redirect()->route('posts.index')->with('success', '投稿が削除されました。');
    }
}

?>