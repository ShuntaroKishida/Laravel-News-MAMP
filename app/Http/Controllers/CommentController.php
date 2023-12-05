<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $rules = [
            'content' => 'required|string',
        ];

        $request->validate($rules);

        $comment = new Comment();
        $comment->content = $request->input('content');
        $comment->post_id = $post->id;
        $comment->save();
        return redirect()->route('posts.show', ['post' => $post->id])->with('success', 'コメントが追加されました。');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->back()->with('success', 'コメントが削除されました。');
    }
}

?>