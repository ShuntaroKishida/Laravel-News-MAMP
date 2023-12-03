<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            個別表示
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto px-6">
        <div class="bg-white w-full rounded-2xl">
            <div class="mt-4 p-4">
                <h1 class="text-lg font-semibold">
                    {{ $post->title }}
                </h1>
                <hr class="w-full">
                <p class="mt-4 whitespace-pre-line">
                    {{ $post->body }}
                </p>
                <!-- 投稿に関連したコメント一覧を表示 -->
                <h2 class="text-lg font-semibold mt-4">コメント一覧</h2>
                @foreach ($post->comments as $comment)
                    <div class="mt-2 p-2 bg-gray-100 rounded">
                        <strong>{{ $comment->name }}</strong>: {{ $comment->content }}
                        <form action="{{ route('comment.destroy', ['post' => $post, 'comment' => $comment]) }}"
                            method="post" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 ml-2">削除</button>
                        </form>
                    </div>
                @endforeach
                <!-- コメント投稿フォーム -->
                <div class="mt-4">
                    <form action="{{ route('comment.store', $post) }}" method="post">
                        @csrf
                        <div class="flex items-center">
                            <input type="text" name="name" placeholder="名前"
                                class="p-2 border border-gray-300 rounded">
                            <input type="text" name="content" placeholder="コメント"
                                class="p-2 border border-gray-300 rounded ml-2 flex-1">
                            <button type="submit" class="bg-blue-500 text-white rounded p-2 ml-2">コメント投稿</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
