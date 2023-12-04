<!-- resources/views/posts/show.blade.php -->

<p><a href="{{ route('posts.index') }}"><h1>Laravel-News</h1></a></p>

<div>
    <h2>{{ $post->title }}</h2>
    <p>{{ $post->content }}</p>
</div>

<h3>コメント一覧</h3>

@foreach ($post->comments as $comment)
    <div>
        <p>{{ $comment->content }}</p>
        <form action="{{ route('comments.destroy', ['comment' => $comment->id]) }}" method="post">
            @csrf
            @method('delete')
            <button type="submit">コメント削除</button>
        </form>
    </div>
@endforeach

<!-- コメントフォーム -->
<form action="{{ route('comments.store', ['post' => $post->id]) }}" method="post">
    @csrf
    <label for="content">コメントを追加:</label>
    <textarea name="content" required></textarea>
    <button type="submit">コメントする</button>
</form>

<p><a href="{{ route('posts.index') }}">投稿一覧に戻る</a></p>
