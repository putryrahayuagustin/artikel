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
        <h1 class="text-2xl font-bold mb-4">Users</h1>
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-semibold mb-2">Name:</label>
                <input type="text" name="name" id="name" value="{{ $user->name }}"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="mb-4">  
                <label for="email" class="block text-gray-700 font-semibold mb-2">Email:</label>
                <input type="email" name="email" id="email" value="{{ $user->email }}"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="mb-4">
                <label for="role" class="block text-gray-700 font-semibold mb-2">Role:</label>
                <select name="role" id="role" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="brimo_id" class="block text-gray-700 font-semibold mb-2">Brimo ID:</label>
                <input type="text" name="brimo_id" id="brimo_id" value="{{ $user->brimo_id }}"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <button type="submit"
                class="px-4 py-2 bg-blue-500 text-white font-semibold rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50">
                Update
            </button>
        </form>
    </div>
@endsection
