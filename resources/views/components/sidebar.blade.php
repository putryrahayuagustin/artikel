<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="icon" href="img/logo.png" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="w-full" x-data="{ isOpen: window.innerWidth >= 1024, showLogoutModal: false }" x-init="window.addEventListener('resize', () => { isOpen = window.innerWidth >= 1024 })">

    <div class="h-screen flex overflow-hidden">
        <!-- Sidebar -->
        <div :class="{ 'translate-x-0 lg:relative': isOpen, '-translate-x-full': !isOpen }"
            class="fixed z-20 inset-y-0 left-0 w-64 dark:bg-gray-900 dark:text-gray-200 text-gray-800 transform transition-transform duration-75 flex-shrink-0">

            <!-- Logo Section -->
            <div class="mt-6 flex justify-between mx-4">
                <div class="img">
                    <h1 class="text-xl text-yellow-600 font-bold">KiBlog</h1>
                </div>
                <button @click="isOpen = !isOpen" x-show="isOpen"
                    class="text-gray-700 hover:text-black dark:text-gray-400 dark:hover:text-white focus:outline-none text-md font-bold">
                    &#10005;
                </button>
            </div>

            <!-- Profile Section -->
            <div
                class="profile flex items-center justify-center my-4 py-4 mx-2 border-y-2 border-gray-400 dark:border-gray-700">
                <div class="img flex flex-col justify-center items-center">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRXJA32WU4rBpx7maglqeEtt3ot1tPIRWptxA&s"
                        class="w-24 h-24 rounded-full" alt="profile">
                    <div class="text text-center mt-2 font-semibold">
                        <h1 class="text-xl font-bold">{{ session('name') }}</h1>
                        <a href="#" class="hover:underline text-gray-500 dark:text-gray-400">Setting</a>
                    </div>
                </div>
            </div>

            <!-- Sidebar Navigation -->
            <nav class="mt-6 border-b-2 border-gray-600 mb-4 pb-2">
                <a href="{{ Auth::user()->role === 'admin' ? route('dashboard-admin') : route('dashboard-user') }}"
                    class="block py-2.5 px-4 mx-4 my-2 rounded transition duration-200 hover:bg-gray-700 hover:text-white
                    {{ request()->routeIs('dashboard-admin') || request()->routeIs('dashboard-user') ? 'bg-gray-700 text-white' : '' }}">
                    Dashboard
                </a>
                <a href="{{ route('myArticle') }}"
                    class="{{ session('role') == 'admin' ? 'hidden' : 'block' }} py-2.5 mx-4 px-4 my-2 rounded transition duration-200 hover:bg-gray-700 hover:text-white {{ request()->routeIs('myArticle') ? 'bg-gray-700 text-white' : '' }}
                    ">
                    My Article
                </a>

            </nav>

            <div class="px-4 mt-6">
                <button @click="showLogoutModal = true"
                    class="block py-2.5 px-4 my-2 rounded transition duration-200 bg-red-800 text-white hover:bg-red-900 hover:text-white w-full text-left">
                    Logout
                </button>
            </div>
        </div>

        <!-- Logout Modal -->
        <div x-show="showLogoutModal"
            class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-96">
                <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-gray-200">Confirm Logout</h2>
                <p class="mb-4 text-gray-600 dark:text-gray-400">Are you sure you want to logout?</p>
                <div class="flex justify-end">
                    <button @click="showLogoutModal = false"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md mr-2 hover:bg-gray-400">
                        Cancel
                    </button>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-red-800 text-white rounded-md hover:bg-red-900">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>

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
                {{ $slot }}
            </main>
        </div>
    </div>
</body>

</html>
