<h1>Laravel-News</h1>

<form action="{{ route('posts.store') }}" method="post">
    @csrf
    <label for="title">タイトル:</label>
    <input type="text" name="title" required>

    <label for="content">投稿内容:</label>
    <textarea name="content" required></textarea>

    <button type="submit">投稿する</button>
</form>

<h2>投稿一覧</h2>

@foreach ($posts as $post)
    <div>
        <h2>{{ $post->title }}</h2>
        <p>{{ $post->content }}</p>
        <p><a href="{{ route('posts.show', ['post' => $post->id]) }}">詳細を見る</a></p>
        <form action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="post">
            @csrf
            @method('delete')
            <button type="submit">削除</button>
        </form>
    </div>
@endforeach
