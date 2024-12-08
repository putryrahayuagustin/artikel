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
    <div class="profile flex items-center justify-center my-4 py-4 mx-2 border-y-2 border-gray-400 dark:border-gray-700">
        <div class="img flex flex-col justify-center items-center">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRXJA32WU4rBpx7maglqeEtt3ot1tPIRWptxA&s"
                class="w-24 h-24 rounded-full" alt="profile">
            <div class="text text-center mt-2 font-semibold">
                <h1 class="text-xl font-bold">{{ session('name') }}</h1>
                <span>Saldo: Rp. {{ number_format($saldo, 2, ',', '.') }}</span>
                {{-- <a href="#" class="hover:underline text-gray-500 dark:text-gray-400">Setting</a> --}}
            </div>
        </div>
    </div>

    <!-- Sidebar Navigation -->
    <nav class="mt-6 border-b-2 border-gray-600 mb-4 pb-2">
        <a href="{{ route('dashboard-user') }}"
            class="block py-2.5 px-4 mx-4 my-2 rounded transition duration-200 hover:bg-gray-700 hover:text-white
                    {{ request()->routeIs('dashboard-admin') || request()->routeIs('dashboard-user') ? 'bg-gray-700 text-white' : '' }}">
            Dashboard
        </a>
        @if (session('role') == 'admin')
        <a href="{{ route('users.index') }}"
            class="block py-2.5 px-4 mx-4 my-2 rounded transition duration-200 hover:bg-gray-700 hover:text-white
                    {{ request()->routeIs('dashboard-admin') || request()->routeIs('dashboard-user') ? 'bg-gray-700 text-white' : '' }}">
            Manage User
        </a>
        @endif

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
<div x-show="showLogoutModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
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
