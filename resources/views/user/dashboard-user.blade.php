<x-sidebar>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-bold mb-4">Dashboard Artikel, Hello {{ session('name') }}</h2>

        <div>
            <h1 class="text-xl font-semibold mb-4">Artikel Viral</h1>

            @foreach ($articles as $article)
                <div class="flex flex-wrap md:flex-nowrap bg-white shadow-md rounded-lg overflow-hidden mb-6">
                    <!-- Image Section -->
                    <div class="w-full md:w-1/3 h-48 md:h-auto">
                        <img src="{{ asset($article->image) }}" alt="image_blog" class="w-full h-full object-cover">
                    </div>

                    <!-- Content Section -->
                    <div class="w-full md:w-2/3 p-4">
                        <div class="text-gray-500 text-sm mb-1">
                            {{ $article->created_at->format('d F Y') }} • {{ $article->created_at->diffForHumans() }}
                        </div>

                        <div class="flex items-center mb-2">
                            <p class="text-gray-700">Author: {{ $article->author->name ?? 'Unknown' }} | Category:
                                {{ $article->category }}</p>
                        </div>

                        <h1 class="text-xl font-bold mb-2">{{ $article->title }}</h1>
                        <p class="text-gray-700 mb-4 leading-relaxed">
                            {!! Str::limit($article->body, 100) !!}
                        </p>

                        <a href="{{ route('article.detail', $article->id) }}"
                            class="text-blue-500 font-semibold">Continue reading →</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-sidebar>
