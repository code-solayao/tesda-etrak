<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-TRAK</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header class="bg-white shadow-md">
        <nav class="container mx-auto p-4 flex justify-between items-center">
            <div class="text-xl font-bold text-gray-800">E-TRAK</div>
            <div class="flex items-center space-x-4">
                <span class="text-gray-600">Welcome, user!</span>
                <form action="" method="POST">
                    @csrf
                    <input type="submit" class="bg-gray-800 text-white px-3 py-2 rounded-md" role="button" name="logout" value="Log Out">
                </form>
            </div>
        </nav>
    </header>
    <div class="flex min-h-screen">
        @if (session('success'))
            <div class="success" id="flash">
                {{ session('success') }}
            </div>
        @endif
        <main class="flex-1 p-6">
            <button>Hello</button>
        </main>
    </div>
</body>
</html>