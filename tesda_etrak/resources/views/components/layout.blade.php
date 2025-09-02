<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ sidebarOpen: false }" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'E-TRAK')</title>
    @yield('vite')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
@php
    $authViews = ['view.login', 'view.signup'];
@endphp
<body id="body">
    <header class="bg-blue-400 shadow-md fixed top-0 left-0 w-full z-20">
        <nav class="container mx-auto p-4 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <!-- Mobile Menu Icon -->
                <button class="md:hidden p-2 rounded-md text-gray-600 hover:bg-gray-200" @click="sidebarOpen = !sidebarOpen">
                    <!-- Hamburger Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <div class="font-[Fremont,Verdana] font-bold text-3xl text-white">
                    @admin
                        <a href="{{ route('admin.index') }}">E-TRAK</a>
                    @endadmin
                    @user
                        <a href="{{ url('/') }}">E-TRAK</a>
                    @enduser
                    @guest
                        <a href="{{ url('/') }}">E-TRAK</a>
                    @endguest
                </div>
            </div>
            <div class="flex items-center space-x-4">
                @if (!in_array(Route::currentRouteName(), $authViews))
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
                @endif
            </div>
        </nav>
    </header>
    <div class="flex flex-1 pt-16">
        @if (!in_array(Route::currentRouteName(), $authViews))
            <!-- Sidebar (Desktop) -->
            <aside class="bg-white shadow-md fixed left-0 top-[4rem] h-[calc(100vh-4rem)] group hidden md:flex flex-col transition-all duration-300 w-20 hover:w-64 z-10">
                <ul class="space-y-4 p-4">
                    <li>
                        <a href="{{ route('index') }}" class="flex items-center space-x-3 py-1 text-gray-700 hover:text-blue-500">
                            <!-- Icon -->
                            <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21H5a2 2 0 01-2-2V7h18v12a2 2 0 01-2 2z" />
                            </svg>
                            <!-- Label -->
                            <span class="hidden group-hover:inline-block transition-opacity duration-200">Home</span>
                        </a>
                    </li>
                    @admin
                        <li>
                            <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 py-1 text-gray-700 hover:text-blue-500">
                                <!-- Icon -->
                                <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21H5a2 2 0 01-2-2V7h18v12a2 2 0 01-2 2z" />
                                </svg>
                                <!-- Label -->
                                <span class="hidden group-hover:inline-block transition-opacity duration-200">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.view-vacancies') }}" class="flex items-center space-x-3 py-1 text-gray-700 hover:text-blue-500">
                                <!-- Icon -->
                                <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
                                </svg>
                                <!-- Label -->
                                <span class="hidden group-hover:inline-block transition-opacity duration-200">Job Vacancies</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.view-records') }}" class="flex items-center space-x-3 py-1 text-gray-700 hover:text-blue-500">
                                <!-- Icon -->
                                <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
                                </svg>
                                <!-- Label -->
                                <span class="hidden group-hover:inline-block transition-opacity duration-200">Table of Graduates</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.view-create') }}" class="flex items-center space-x-3 py-1 text-gray-700 hover:text-blue-500">
                                <!-- Icon -->
                                <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
                                </svg>
                                <!-- Label -->
                                <span class="hidden group-hover:inline-block transition-opacity duration-200">Create Graduate Record</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.view-sheets-data') }}" class="flex items-center space-x-3 py-1 text-gray-700 hover:text-blue-500">
                                <!-- Icon -->
                                <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21H5a2 2 0 01-2-2V7h18v12a2 2 0 01-2 2z" />
                                </svg>
                                <!-- Label -->
                                <span class="hidden group-hover:inline-block transition-opacity duration-200">Via Google Sheets</span>
                            </a>
                        </li>
                    @endadmin
                    @user
                        <li>
                            <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 py-1 text-gray-700 hover:text-blue-500">
                                <!-- Icon -->
                                <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21H5a2 2 0 01-2-2V7h18v12a2 2 0 01-2 2z" />
                                </svg>
                                <!-- Label -->
                                <span class="hidden group-hover:inline-block transition-opacity duration-200">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('view.vacancies') }}" class="flex items-center space-x-3 py-1 text-gray-700 hover:text-blue-500">
                                <!-- Icon -->
                                <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
                                </svg>
                                <!-- Label -->
                                <span class="hidden group-hover:inline-block transition-opacity duration-200">Job Vacancies</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('view-records') }}" class="flex items-center space-x-3 py-1 text-gray-700 hover:text-blue-500">
                                <!-- Icon -->
                                <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
                                </svg>
                                <!-- Label -->
                                <span class="hidden group-hover:inline-block transition-opacity duration-200">Table of Graduates</span>
                            </a>
                        </li>
                    @enduser
                    @guest
                        <li>
                            <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 py-1 text-gray-700 hover:text-blue-500">
                                <!-- Icon -->
                                <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21H5a2 2 0 01-2-2V7h18v12a2 2 0 01-2 2z" />
                                </svg>
                                <!-- Label -->
                                <span class="hidden group-hover:inline-block transition-opacity duration-200">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('view.vacancies') }}" class="flex items-center space-x-3 py-1 text-gray-700 hover:text-blue-500">
                                <!-- Icon -->
                                <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
                                </svg>
                                <!-- Label -->
                                <span class="hidden group-hover:inline-block transition-opacity duration-200">Job Vacancies</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('view-records') }}" class="flex items-center space-x-3 py-1 text-gray-700 hover:text-blue-500">
                                <!-- Icon -->
                                <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
                                </svg>
                                <!-- Label -->
                                <span class="hidden group-hover:inline-block transition-opacity duration-200">Table of Graduates</span>
                            </a>
                        </li>
                    @endguest
                    <li>
                        <a href="http://www.tesda.gov.ph" target="_blank" rel="noopener noreferrer" 
                        class="flex items-center space-x-3 py-1 text-gray-700 hover:text-blue-500">
                            <!-- Icon -->
                            <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <!-- Label -->
                            <span class="hidden group-hover:inline-block transition-opacity duration-200">
                                Visit <b class="font-[Fremont,Verdana]">TESDA</b> website
                            </span>
                        </a>
                    </li>
                </ul>
            </aside>

            {{-- <aside class="w-64 bg-sky-50 shadow-md p-6 hidden md:block fixed left-0 top-16 h-[calc(100vh-4rem)]">
                <ul class="space-y-4 tab">
                    @admin
                        <li><a href="{{ route('admin.dashboard') }}" class="tablinks">Dashboard</a></li>
                        <li><a href="{{ route('admin.view-records') }}" class="tablinks">View records</a></li>
                        <li><a href="{{ route('admin.view-create') }}" class="tablinks">Create a record</a></li>
                        <li><a href="{{ route('admin.view-sheets-data') }}" class="tablinks">Google Sheets Data</a></li>
                        <li><a href="{{ route('admin.view-vacancies') }}" class="tablinks">Job Vacancies</a></li>
                    @endadmin
                    @user
                        <li><a href="{{ route('dashboard') }}" class="tablinks">Dashboard</a></li>
                        <li><a href="{{ route('view-records') }}" class="tablinks">View records</a></li>
                        <li><a href="{{ route('view.vacancies') }}" class="tablinks">Job Vacancies</a></li>
                    @enduser
                    @guest
                        <li><a href="{{ route('dashboard') }}" class="tablinks">Dashboard</a></li>
                        <li><a href="{{ route('view-records') }}" class="tablinks">View records</a></li>
                        <li><a href="{{ route('view.vacancies') }}" class="tablinks">Job Vacancies</a></li>
                    @endguest
                    <li>
                        <a href="http://www.tesda.gov.ph" target="_blank" rel="noopener noreferrer" class="tablinks">
                            Visit <b class="font-[Fremont,Verdana]">TESDA</b> website
                        </a>
                    </li>
                </ul>
            </aside> --}}
            <!-- Sidebar (Mobile Overlay) -->
            <div class="fixed inset-0 z-30 bg-black bg-opacity-50 md:hidden" 
                x-show="sidebarOpen" 
                @click="sidebarOpen = false" 
                x-transition.opacity>
            </div>
            <!-- Mobile Sidebar -->
            <aside class="fixed top-16 left-0 w-64 bg-white shadow-md p-6 h-[calc(100vh-4rem)] z-40 transform transition-transform duration-300 ease-in-out md:hidden" 
                x-show="sidebarOpen" 
                x-transition:enter="translate-x-0" 
                x-transition:leave="-translate-x-full" 
                :class="{ '-translate-x-full': !sidebarOpen, 'translate-x-0': sidebarOpen }">
                <!-- Close Button (Mobile) -->
                <div class="flex justify-end mb-4">
                    <button class="p-2 rounded-md text-gray-600 hover:bg-gray-200" @click="sidebarOpen = false">
                        <!-- "Close" Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                <!-- Links -->
                <ul class="space-y-4 tab">
                    @admin
                        <li><a href="{{ route('admin.dashboard') }}" class="tablinks">Dashboard</a></li>
                        <li><a href="{{ route('admin.view-records') }}" class="tablinks">View records</a></li>
                        <li><a href="{{ route('admin.view-create') }}" class="tablinks">Create a record</a></li>
                        <li><a href="{{ route('admin.view-sheets-data') }}" class="tablinks">Google Sheets Data</a></li>
                        <li><a href="{{ route('admin.view-vacancies') }}" class="tablinks">Job Vacancies</a></li>
                    @endadmin
                    @user
                        <li><a href="{{ route('dashboard') }}" class="tablinks">Dashboard</a></li>
                        <li><a href="{{ route('view-records') }}" class="tablinks">View records</a></li>
                        <li><a href="{{ route('view.vacancies') }}" class="tablinks">Job Vacancies</a></li>
                    @enduser
                    @guest
                        <li><a href="{{ route('dashboard') }}" class="tablinks">Dashboard</a></li>
                        <li><a href="{{ route('view-records') }}" class="tablinks">View records</a></li>
                        <li><a href="{{ route('view.vacancies') }}" class="tablinks">Job Vacancies</a></li>
                    @endguest
                    <li>
                        <a href="http://www.tesda.gov.ph" target="_blank" rel="noopener noreferrer" class="tablinks">
                            Visit <b class="font-[Fremont,Verdana]">TESDA</b> website
                        </a>
                    </li>
                </ul>
            </aside>
        @endif
        <!-- Main -->
        <main class="flex-1 overflow-y-auto p-6 ml-20 h-[calc(100vh-4rem)]">
            <header class="mb-10">
                @if (session('success'))
                    <div class="p-3 mb-3 text-center bg-green-200 text-green-600 font-semibold text-lg block rounded border drop-shadow">
                        {{ session('success') }}
                    </div>
                @endif
                
                <h1 class="text-2xl font-bold text-gray-600">@yield('main')</h1>
            </header>
            {{ $slot }}
        </main>
    </div>
</body>
</html>