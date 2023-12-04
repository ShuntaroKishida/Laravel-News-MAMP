<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        // バリデーションルールの設定
        $rules = [
            'content' => 'required|string',
        ];

        // バリデーションの実行
        $request->validate($rules);

        // 新しいコメントを作成して保存
        $comment = new Comment();
        $comment->content = $request->input('content');
        $comment->post_id = $post->id; // 投稿とコメントを関連付ける
        $comment->save();

        // 成功時のリダイレクトなどを適切に処理する
        return redirect()->route('posts.show', ['post' => $post->id])->with('success', 'コメントが追加されました。');
    }

    public function destroy(Comment $comment)
    {
        // コメントを削除
        $comment->delete();

        // 成功時のリダイレクトなどを適切に処理する
        return redirect()->back()->with('success', 'コメントが削除されました。');
    }
}

?>