<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-TRAK</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body id="body">
    <header class="bg-blue-400 shadow-md static top-0 left-0 w-full z-10">
        <nav class="container mx-auto p-4 flex justify-between items-center">
            <div class="font-[Fremont,Verdana] font-bold text-3xl text-white">E-TRAK</div>
            <div class="flex items-center space-x-4">
                @guest
                    <div class="flex flex-row-reverse">
                        <a href="{{ route('view.login') }}" class="btn btn-secondary bg-blue-100 hover:bg-blue-200 text-blue-700 ml-5">Log In</a>
                        <a href="{{ route('view.signup') }}" class="btn btn-secondary bg-indigo-500 hover:bg-indigo-400">Sign Up</a>
                    </div>
                @endguest
                @auth
                    <span class="text-white text-lg border-r-2 pr-2">
                        Welcome, <b>{{ Auth::user()->name }}</b>
                    </span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <input type="submit" class="btn btn-secondary bg-blue-100 hover:bg-blue-200 text-blue-700" role="button" name="logout" value="Log Out" />
                    </form>
                @endauth
            </div>
        </nav>
    </header>
    <div class="flex">
        <main class="flex-1 px-24 py-6">
            @if (session('success'))
                <div class="p-3 mb-3 text-center bg-green-200 text-green-600 font-semibold text-lg block rounded border drop-shadow">
                    {{ session('success') }}
                </div>
            @endif
            <div class="text-center mb-10">
                <img src="{{ asset('images/logo.png') }}" alt="TESDA Logo" class="block ml-auto mr-auto" width="200" height="200">
                <h1 class="mb-2">Welcome</h1>
                <p>This is a project of the <strong>Employment Monitoring System</strong></p>
            </div>
            <div class="text-center">
                <a href="{{ route('dashboard') }}" class="btn btn-primary inline-block">Dashboard</a>
                <a href="{{ route('view-records') }}" class="btn btn-primary inline-block">View Records</a>
            </div>
        </main>
    </div>
</body>
</html>