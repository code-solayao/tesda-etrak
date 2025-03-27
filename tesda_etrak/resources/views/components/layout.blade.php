<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'E-TRAK')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body id="body">
    <header class="bg-white shadow-md">
        <nav class="container mx-auto p-4 flex justify-between items-center">
            <a href="{{ url('/') }}" class="font-[Fremont,Verdana] font-bold text-3xl text-blue-700">E-TRAK</a>
            <div class="flex items-center space-x-4">
                <span class="text-gray-600 border-r-2 pr-2">
                    Welcome, {{ Auth::user()->name }}
                </span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <input type="submit" class="btn btn-secondary" role="button" name="logout" value="Log Out">
                </form>
            </div>
        </nav>
    </header>
    <div class="flex min-h-screen">
        {{-- Sidebar --}}
        <aside class="w-64 bg-[#f1f1f1] shadow-md p-6 hidden md:block">
            <ul class="space-y-4 tab">
                <li><a href="#" class="tablinks">Dashboard</a></li>
                <li><a href="{{ route('view-records') }}" class="tablinks">View records</a></li>
                <li><a href="#" class="tablinks">Create a record</a></li>
                <li><a href="#" class="tablinks">Import an Excel file</a></li>
            </ul>
        </aside>
        {{-- Main --}}
        @if (session('success'))
            <div class="success" id="flash">
                {{ session('success') }}
            </div>
        @endif
        <main class="flex-1 px-24 py-6">
            {{ $slot }}
        </main>
    </div>
</body>
</html>