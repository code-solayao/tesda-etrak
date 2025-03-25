<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>E-TRAK - Welcome</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="container">
        <main class="pb-3" role="main">

            <div class="center text-center">
                <h1 class="display-4">Welcome to <strong>E-TRAK</strong> by TESDA-NCR</h1>
                <a href="{{ route('login-page') }}" class="btn btn-primary" role="button">Go to Login</a>
            </div>

        </main>
    </div>
</body>
</html>