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
        @if ($users->isEmpty())
            <p class="text-gray-500">List user kosong</p>
        @else
            <div class="grid grid-cols-1 gap-4">
                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">ID</th>
                            <th class="px-4 py-2">Name</th>
                            <th class="px-4 py-2">Email</th>
                            <th class="px-4 py-2">Role</th>
                            <th class="px-4 py-2">Brimo ID</th>

                            <th class="px-4 py-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td class="border px-4 py-2">{{ $user->id }}</td>
                                <td class="border px-4 py-2">{{ $user->name }}</td>
                                <td class="border px-4 py-2">{{ $user->email }}</td>
                                <td class="border px-4 py-2">{{ $user->role }}</td>
                                <td class="border px-4 py-2">{{ $user->brimo_id }}</td>
                                <td class="border px-4 py-2">
                                    <a href="{{ route('users.edit', $user->id) }}"
                                        class="px-4 py-2 bg-blue-500 text-white font-semibold rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50">
                                        Edit
                                    </a>
                                </td>
                            </tr>    
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
