<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'E-TRAK')</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/components/layout.css') }}">
    @yield('styles')
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-sm navbar-toggleable-sm navbar-light bg-white border-bottom box-shadow mb-3">
            <div class="container-fluid">
                <a class="navbar-brand" style="font-weight: bold;">E-TRAK</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target=".navbar-collapse" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse collapse d-sm-inline-flex justify-content-between">
                    <ul class="navbar-nav flex-grow-1">
                        <li class="nav-item">
                            <a href="{{ route('e-trak') }}" class="nav-link text-dark">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="https://lookerstudio.google.com/reporting/9d6c7c0a-dcfb-4dda-ba67-589c230b57bd/page/GzuKE?fbclid=IwY2xjawGZXIlleHRuA2FlbQIxMAABHWw1eJ0SY4OlJju7W9T7gV5eNEVFGy5QgPEYOM0jkeni293iDCwtfhtkkQ_aem_jBd-8gTDT5g2pEeWlbhpFQ" 
                                class="nav-link text-dark" target="_blank">Dashboard</a>
                        </li>
                    </ul>
                    <div class="form-group text-end">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <input type="submit" class="btn btn-secondary text-end" role="button" name="logout" value="Log Out">
                        </form>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    @if (session('success'))
        <div class="success" id="flash">
            {{ session('success') }}
        </div>
    @endif
    <div class="container">
        <main class="pb-3" role="main">
            {{ $slot }}
        </main>
    </div>

    @yield('scripts')
</body>
</html>