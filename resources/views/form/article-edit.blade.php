@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-5">
        @if (session('success'))
            <div x-data="{ open: true }" x-show="open" x-init="setTimeout(() => open = false, 3000)"
                class="absolute top-20 right-20 px-4 py-3 bg-green-500 text-white rounded-lg shadow-lg">
                {{ session('success') }}
                <button @click="open = false" class="ml-2 font-bold">x</button>
            </div>
        @endif
        <h1 class="text-2xl font-bold mb-4">Edit Artikel</h1>
        <form action="{{ route('article.update', $article->id) }}" method="POST" enctype="multipart/form-data"
            class="space-y-5">
            @csrf
            @method('PUT')

            @if ($errors->any())
                <div class="bg-red-500 text-white p-3 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Judul -->
            <div>
                <label for="title" class="block text-gray-800 font-medium mb-1">Judul</label>
                <input type="text" name="title" id="title" value="{{ old('title', $article->title) }}" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent"
                    placeholder="Masukkan judul artikel">
            </div>

            <!-- Kategori -->
            <div>
                <label for="category" class="block text-gray-800 font-medium mb-1">Kategori</label>
                <select name="category" id="category" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent">
                    <option value="" disabled>Pilih Kategori</option>
                    <option value="Teknologi" {{ $article->category == 'Teknologi' ? 'selected' : '' }}>Teknologi
                    </option>
                    <option value="Kesehatan" {{ $article->category == 'Kesehatan' ? 'selected' : '' }}>Kesehatan
                    </option>
                    <option value="Pendidikan" {{ $article->category == 'Pendidikan' ? 'selected' : '' }}>Pendidikan
                    </option>
                    <option value="Olahraga" {{ $article->category == 'Olahraga' ? 'selected' : '' }}>Olahraga
                    </option>
                    <option value="Hiburan" {{ $article->category == 'Hiburan' ? 'selected' : '' }}>Hiburan</option>
                    <option value="Keperawatan" {{ $article->category == 'Keperawatan' ? 'selected' : '' }}>
                        Keperawatan</option>
                </select>
            </div>

            <!-- Price -->
            <div>
                <label for="price" class="block text-gray-800 font-medium mb-1">Harga</label>
                <input type="number" name="price" id="price" value="{{ old('price', $article->price) }}" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent"
                    placeholder="Masukkan harga artikel">
            </div>

            <!-- Gambar -->
            <div>
                <label for="image" class="block text-gray-800 font-medium mb-1">Gambar</label>
                <input type="file" name="image" id="image"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent">
                <p class="text-sm text-gray-500 mt-1">Gambar saat ini: {{ $article->image ?? 'Tidak ada gambar' }}
                </p>
            </div>

            <!-- Konten -->
            <div>
                <label for="body" class="block text-gray-800 font-medium mb-1">Konten</label>
                <textarea name="body" id="body" rows="10" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent"
                    placeholder="Tuliskan konten artikel di sini...">{{ old('body', $article->body) }}</textarea>
            </div>

            <!-- Tombol Submit -->
            <div class="text-center">
                <button type="submit"
                    class="w-full  md:w-auto px-6 py-3 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300 shadow-lg">
                    Perbarui Artikel
                </button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('body');
    </script>
@endsection