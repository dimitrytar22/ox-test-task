<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM system - @yield('title')</title>
    @vite(["resources/js/app.js", "resources/css/app.css"])
</head>

<body class="bg-gray-50">

<header class="bg-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center">
                <a href="{{route('home')}}" class="text-2xl font-bold text-gray-900">CRM</a>
            </div>
            <div class="flex items-center space-x-6">
                <a href="{{route('clients.index')}}" class="text-gray-700 hover:text-gray-900 hover:underline transition duration-300 ease-in-out px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300">Clients</a>
            </div>

            <div class="relative">
                <button class="text-gray-700 hover:text-gray-900 transition duration-300 ease-in-out px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 flex items-center">
                    <span class="mr-2">{{\Illuminate\Support\Facades\Auth::user()->name}}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 hidden">
                    <a href="{{route('profile.edit')}}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Profile</a>
                    <a href="{{ route('logout') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Logout</a>
                </div>
            </div>

            <div class="md:hidden">
                <button class="text-gray-700" id="menu-toggle">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</header>

<main class="mt-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @yield('content')
    </div>
</main>

<script>
    const profileButton = document.querySelector('.relative > button');
    const dropdown = document.querySelector('.relative > div');

    profileButton.addEventListener('click', () => {
        dropdown.classList.toggle('hidden');
    });

    document.getElementById('menu-toggle').addEventListener('click', function () {
        const mobileMenu = document.getElementById('mobile-menu');
        mobileMenu.classList.toggle('hidden');
    });
</script>

</body>

</html>
