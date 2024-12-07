<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="icon" href="img/logo.png" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="w-full" x-data="{ isOpen: window.innerWidth >= 1024, showLogoutModal: false }" x-init="window.addEventListener('resize', () => { isOpen = window.innerWidth >= 1024 })">

    <div class="h-screen flex overflow-hidden">
        <!-- Sidebar -->
        <x-sidebar></x-sidebar>

        <!-- Main Content -->
        <div class="flex flex-col w-full transition-all duration-200">
            <header
                class="top-0 left-0 right-0 z-10 flex items-center justify-end px-4 h-16 bg-gray-100 dark:bg-gray-800 dark:text-white shadow">
                <!-- Mobile Sidebar Button -->
                <button @click="isOpen = !isOpen" x-show="!isOpen"
                    class="text-white hover:bg-yellow-600 focus:outline-none bg-yellow-500 rounded-md py-1 items-center flex px-4 absolute top-12 -left-4">
                    <span class="ml-2 text-md font-bold">&#9776; <span
                            class="font-bold ml-2 text-md">SIDEBAR</span></span>
                </button>
                <a href="{{ route('mulai-menulis') }}">
                    <button
                        class="px-4 py-2 bg-blue-500 text-white font-semibold rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50">
                        Mulai Menulis
                    </button>
                </a>
            </header>
            <main class="flex-1 overflow-y-auto py-10 px-4 bg-gray-100 px-14 py-8">
                @yield('content')
            </main>
        </div>
    </div>
</body>

</html>
