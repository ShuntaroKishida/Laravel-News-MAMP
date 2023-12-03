<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-grey-800 leading-tight">
            Laravel News
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto px-6">
        <form method="post" action="{{ route('post.store') }}" onsubmit="return confirmSubmit()">
            @csrf
            <div class="mt-8">
                <div class="w-full flex flex-col">
                    <label for="title" class="font-semibold mt-4">タイトル</label>
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    <input type="text" name="title" class="w-auto py-2 border border-gray-300 rounded-md"
                        id="title" value="{{ old('title') }}">
                </div>
            </div>
            <div class="w-full flex flex-col">
                <label for="body" class="font-semibold mt-4">本文</label>
                <x-input-error :messages="$errors->get('body')" class="mt-2" />
                <textarea name="body" class="w-auto py-2 border border-gray-300 rounded-md" id="body" cols="30"
                    rows="5">{{ old('body') }}</textarea>
            </div>
            <x-primary-button class="mt-4">
                投稿する
            </x-primary-button>
        </form>
    </div>

    <script>
        function confirmSubmit() {
            var confirmation = confirm("本当に保存しますか？");
            return confirmation;
        }
    </script>

    <div class="mx-auto px-6">
        @foreach ($posts as $post)
            <div class="mt-4 p-8 bg-white w-full rounded-2xl">
                <h1 class="p-4 text-lg font-semibold">
                    <a href="{{ route('post.show', $post) }}" class="text-blue-600">
                        {{ $post->title }}
                    </a>
                </h1>
                <hr class="w-full">
                <p class="mt-4 p-4">
                    {{ $post->body }}
                </p>
            </div>
        @endforeach
    </div>
</x-app-layout>
