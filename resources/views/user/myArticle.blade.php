<x-sidebar>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container mx-auto mt-5">
        @if (session('success'))
            <div x-data="{ open: true }" x-show="open" x-init="setTimeout(() => open = false, 3000)"
                class="absolute top-20 right-20 px-4 py-3 bg-green-500 text-white rounded-lg shadow-lg">
                {{ session('success') }}
                <button @click="open = false" class="ml-2 font-bold">x</button>
            </div>
        @endif
        <h1 class="text-2xl font-bold mb-4">Artikel Saya</h1>
        @if ($articles->isEmpty())
            <p class="text-gray-500">Anda belum memiliki artikel.</p>
        @else
            <div class="grid grid-cols-1 gap-4">
                @foreach ($articles as $article)
                    <div class="bg-white border border-gray-200 rounded-lg shadow-md flex flex-row gap-4">
                        <div class="w-full md:w-1/3 h-48 md:h-auto">
                            <a href="{{ route('article.detail', $article->id) }}">
                                <img src="{{ asset($article->image) }}"
                                    alt="{{ $article->image == null ? 'gambar_kosong' : $article->image }}"
                                    class="w-full h-full object-cover">
                            </a>
                        </div>

                        <div class="content py-4 w-full flex flex-col justify-between pr-4">
                            <a href="{{ route('article.detail', $article->id) }}" class="flex flex-col h-full">
                                <div class="head-body">
                                    <div class="flex items-center mb-4">
                                        <div
                                            class="bg-blue-500 text-white px-2 py-1 text-xs font-semibold rounded-full mr-2">
                                            {{ $article->category }}</div>
                                    </div>
                                    <h2 class="text-lg font-semibold mb-2">{{ $article->title }}</h2>
                                    <p class="text-sm text-gray-500 mb-4">
                                        <span class="font-semibold">{{ $article->author->name }}</span> &#8226;
                                        {{ $article->created_at->format('d F Y') }} •
                                        {{ $article->created_at->diffForHumans() }}
                                    </p>

                                    <p class="text-gray-700 mb-4 leading-relaxed">
                                        {!! Str::limit($article->body, 100) !!}
                                    </p>
                                </div>
                            </a>
                            <div class="flex items-end justify-end">
                                <div class="flex space-x-2">
                                    <a href="{{ route('article.edit', $article->id) }}"
                                        class="text-blue-500 hover:underline">Edit</a>

                                    <form action="{{ route('article.destroy', $article->id) }}" method="POST"
                                        class="inline"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-sidebar>
