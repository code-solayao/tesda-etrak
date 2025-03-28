<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'E-TRAK')</title>
    @yield('vite')
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
        <aside class="w-64 bg-[#f1f1f1] shadow-lg p-6 hidden md:block">
            <ul class="space-y-4 tab">
                <li>
                    <a href="https://lookerstudio.google.com/reporting/9d6c7c0a-dcfb-4dda-ba67-589c230b57bd/page/GzuKE?fbclid=IwY2xjawGZXIlleHRuA2FlbQIxMAABHWw1eJ0SY4OlJju7W9T7gV5eNEVFGy5QgPEYOM0jkeni293iDCwtfhtkkQ_aem_jBd-8gTDT5g2pEeWlbhpFQ" 
                    class="tablinks" target="_blank" role="tab">Dashboard</a>
                </li>
                <li><a href="{{ route('view-records') }}" class="tablinks">View records</a></li>
                <li><a href="{{ route('view.create') }}" class="tablinks">Create a record</a></li>
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