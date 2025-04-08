<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'E-TRAK')</title>
    @yield('vite')
</head>
<body id="body">
    <header class="bg-white shadow-md fixed top-0 left-0 w-full z-10">
        <nav class="container mx-auto p-4 flex justify-between items-center">
            <a href="{{ url('/') }}" class="font-[Fremont,Verdana] font-bold text-3xl text-blue-700">E-TRAK</a>
            <div class="flex items-center space-x-4">
                @guest
                    <div class="flex flex-row-reverse">
                        <a href="{{ route('view.login') }}" class="btn btn-secondary ml-5">Log In</a>
                        <a href="{{ route('view.signup') }}" class="btn btn-secondary">Sign Up</a>
                    </div>
                @endguest
                @auth
                    <span class="text-gray-600 border-r-2 pr-2">
                        Welcome, {{ Auth::user()->name }}
                    </span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <input type="submit" class="btn btn-secondary" role="button" name="logout" value="Log Out">
                    </form>
                @endauth
            </div>
        </nav>
    </header>
    <div class="flex flex-1 pt-16">
        {{-- Sidebar --}}
        <aside class="w-64 bg-[#f1f1f1] shadow-lg p-6 hidden md:block fixed left-0 top-16 h-[calc(100vh-4rem)]">
            <ul class="space-y-4 tab">
                <li><a href="{{ route('dashboard') }}" class="tablinks">Dashboard</a></li>
                <li><a href="{{ route('view-records') }}" class="tablinks">View records</a></li>
                <li><a href="{{ route('view.create') }}" class="tablinks">Create a record</a></li>
                <li><a href="#" class="tablinks">Import an Excel file</a></li>
            </ul>
        </aside>
        {{-- Main --}}
        <main class="flex-1 overflow-y-auto p-6 ml-64 h-[calc(100vh-4rem)]">
            <header class="mb-10">
                @if (session('success'))
                    <div class="p-3 mb-3 text-center bg-green-200 text-green-600 font-semibold text-lg block rounded border drop-shadow">
                        {{ session('success') }}
                    </div>
                @endif
                <h1 class="text-2xl font-bold text-gray-600">@yield('main', 'Title')</h1>
            </header>
            {{ $slot }}
        </main>
    </div>
</body>
</html>