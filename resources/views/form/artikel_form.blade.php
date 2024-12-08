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
        <h1 class="text-2xl font-bold mb-4">Tambah Artikel Baru</h1>

        <form action="{{ route('article.create') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

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
                <input type="text" name="title" id="title" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent"
                    placeholder="Masukkan judul artikel">
            </div>

            <!-- Kategori -->
            <div>
                <label for="category" class="block text-gray-800 font-medium mb-1">Kategori</label>
                <select name="category" id="category" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent">
                    <option value="" disabled selected>Pilih Kategori</option>
                    <option value="Teknologi">Teknologi</option>
                    <option value="Kesehatan">Kesehatan</option>
                    <option value="Pendidikan">Pendidikan</option>
                    <option value="Olahraga">Olahraga</option>
                    <option value="Hiburan">Hiburan</option>
                    <option value="Keperawatan">Keperawatan</option>

                </select>
            </div>
            <!-- price -->
            <div>
                <label for="price" class="block text-gray-800 font-medium mb-1">Harga</label>
                <input type="number" name="price" id="price" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent"
                    placeholder="Masukkan harga artikel">
            </div>
            
            <!-- Gambar -->
            <div>
                <label for="image" class="block text-gray-800 font-medium mb-1">Gambar</label>
                <input type="file" name="image" id="image"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent">
            </div>

            <!-- Konten -->
            <div>
                <label for="body" class="block text-gray-800 font-medium mb-1">Konten</label>
                <textarea name="body" id="body" rows="10" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent"
                    placeholder="Tuliskan konten artikel di sini..."></textarea>
            </div>

            <!-- Tombol Submit -->
            <div class="text-center">
                <button type="submit"
                    class="w-full md:w-auto px-6 py-3 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300 shadow-lg">
                    Simpan Artikel
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
