@extends('layouts.app')

@section('title', $title)

@section('content')
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-bold mb-4">Dashboard Artikel, Hello {{ session('name') }}</h2>

        <div>
            <h1 class="text-xl font-semibold mb-4">Artikel Viral</h1>

            @foreach ($articles as $article)
                <div class="flex flex-wrap md:flex-nowrap bg-white shadow-md rounded-lg overflow-hidden mb-6">
                    <!-- Image Section -->
                    <div class="w-full md:w-1/3 h-48 md:h-auto">
                        <img src="{{ asset($article->image) }}"
                            alt="{{ $article->image == null ? 'gambar_kosong' : $article->image }}"
                            class="w-full h-full object-cover">
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
                        <p class="text-gray-700 font-semibold">Harga: Rp.    {{ number_format($article->price, 2, ',', '.') }}</p>

                        @if (in_array($article->id, $userArtikelIds) || auth()->user()->id == $article->user_id)
                            <a href="{{ route('article.detail', $article->id) }}"
                                class="text-blue-500 font-semibold">Continue
                                reading →</a>
                        @else
                            <a href="#" class="text-blue-500 font-semibold buy-now" data-id="{{ $article->id }}">Beli
                                Sekarang →</a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('.buy-now').click(function() {
            var id = $(this).data('id');
            swal({
                    title: "Beli Artikel?",
                    text: "Apakah Kamu Yakin Membeli Artikel Ini?!!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((yes) => {
                    if (yes) {
                        // redirect to the buy route
                        window.location.href = "{{ route('article.buy', ':id') }}".replace(':id', id);
                    }
                });
        });
    </script>
@endsection
