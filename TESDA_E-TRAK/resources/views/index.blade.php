<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-TRAK - Welcome</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        .content-centered {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
</head>
<body>
    <div class="container">
        <main role="main" class="pb-3">

            <div class="text-center content-centered">
                <h1 class="display-4">Welcome to the <strong>E-TRAK</strong> website by TESDA</h1>
                <a href="{{ route('login.index') }}" class="btn btn-primary">Go to Login</a>
            </div>
            
        </main>
    </div>
</body>
</html>