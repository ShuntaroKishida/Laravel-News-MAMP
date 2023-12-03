<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function create()
    {
        return view('comment.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'nullable',
            'content' => 'required|max:50',
        ]);

        // 投稿IDを取得する（例：ルートパラメータから取得する場合）
        $postId = $request->route('post'); // ルートパラメータの名前に合わせて変更してください

        // バリデーションを通過した後の処理
        $comment = new Comment();
        $comment->name = $validated['name'];
        $comment->content = $validated['content'];

        // 関連する投稿のIDを設定
        $comment->post_id = $postId;

        $comment->save();

        // 保存したコメントを関連する投稿のページにリダイレクト
        return redirect()->route('post.show', ['post' => $postId]);
    }

    public function destroy($post, Comment $comment)
    {
        // コメントの削除処理
        $comment->delete();

        // リダイレクト先を指定（例：投稿の詳細ページに戻る）
        return redirect()->route('post.show', ['post' => $post]);
    }
}
