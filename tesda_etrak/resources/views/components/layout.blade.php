<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'E-TRAK')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header class="bg-white shadow-md">
        <nav class="container mx-auto p-4 flex justify-between items-center">
            <div class="text-xl font-bold text-gray-800">E-TRAK</div>
            <div class="flex items-center space-x-4">
                <span class="text-gray-600">Welcome, TestUser!</span>
                <form action="" method="POST">
                    @csrf
                    <input type="submit" class="bg-gray-800 text-white px-3 py-2 rounded-md" role="button" name="logout" value="Log Out">
                </form>
            </div>
        </nav>
    </header>
    <div class="flex min-h-screen">
        {{-- Sidebar --}}
        <aside class="w-64 bg-white shadow-md p-6 hidden md:block">
            <ul class="space-y-4">
                <li><a href="#" class="block text-gray-700 hover:text-blue-500">Dashboard</a></li>
                <li><a href="#" class="block text-gray-700 hover:text-blue-500">View Records</a></li>
                <li><a href="#" class="block text-gray-700 hover:text-blue-500">Import Excel File</a></li>
            </ul>
        </aside>
        {{-- Main --}}
        @if (session('success'))
            <div class="success" id="flash">
                {{ session('success') }}
            </div>
        @endif
        <main class="flex-1 p-6">
            {{ $slot }}
        </main>
    </div>
</body>
</html>