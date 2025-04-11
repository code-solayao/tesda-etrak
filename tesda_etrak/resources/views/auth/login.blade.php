<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-TRAK - Sign in</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <main role="main">

        <div class="flex items-center justify-center min-h-screen bg-sky-200">
            <div class="w-full max-w-md p-8 space-y-6 bg-sky-300 border-2 rounded-2xl shadow-lg">
                <h2 class="text-2xl font-bold text-center text-gray-800">
                    Sign in to <a href="{{ route('index') }}" class="font-[FremontBold,Verdana] text-blue-700">E-TRAK</a>
                </h2>
                @if ($errors->any())
                    <ul class="px-3 py-2 bg-red-400 rounded-md">
                        @foreach ($errors->all() as $error)
                            <li class="text-md text-white">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <form action="{{ route('login') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <input type="email" name="email" 
                        class="w-full px-4 py-2 mt-1 text-gray-800 bg-gray-100 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                        placeholder="E-mail" autofocus />
                    </div>
                    <div>
                        <input type="password" name="password" 
                        class="w-full px-4 py-2 mt-1 text-gray-800 bg-gray-100 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                        placeholder="Password" />
                    </div>
                    <div class="flex items-center justify-between">
                        <label for="remember_me" class="flex items-center">
                            <input type="checkbox" id="remember_me" name="remember" class="text-blue-600 border-gray-300 rounded focus:ring-blue-500" />
                            <span class="ml-1 text-sm text-gray-700">Remember me</span>
                        </label>
                        <a href="#" class="text-sm text-blue-700 hover:underline">Forgot password?</a>
                    </div>
                    <div>
                        <input type="submit" name="login" value="Sign In" 
                        class="w-full px-4 py-2 font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500" />
                    </div>
                </form>
                <div>
                    <p class="text-sm text-center text-gray-700">
                        Create an account 
                        <a href="{{ route('view.signup') }}" class="text-blue-700 hover:underline">here</a>.
                    </p>
                </div>
            </div>
        </div>

    </main>
</body>
</html>