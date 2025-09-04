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
    <header class="bg-blue-400 fixed left-0 shadow-md top-0 w-full z-20">
        <nav class="lg:hidden container mx-auto p-4">
            <div class="flex items-center justify-between relative">
                @if (!in_array(Route::currentRouteName(), $authViews))
                    <!-- Hamburger Menu Icon -->
                    <button class="text-white hover:bg-blue-500 p-2 rounded-md" @click="sidebarOpen = !sidebarOpen">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                @else
                    <!-- Home Icon -->
                    <a href="{{ route('home') }}" class="text-white hover:bg-blue-500 p-2 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                    </a>
                @endif
                <div class="text-white absolute font-[Fremont,Verdana] font-bold left-1/2 text-3xl transform -translate-x-1/2">
                    @admin
                        <a href="{{ route('admin.home') }}">E-TRAK</a>
                    @endadmin
                    @user
                        <a href="{{ route('home') }}">E-TRAK</a>
                    @enduser
                    @guest
                        <a href="{{ route('home') }}">E-TRAK</a>
                    @endguest
                </div>
                @if (!in_array(Route::currentRouteName(), $authViews))
                    @guest
                        <div class="flex flex-row-reverse">
                            <a href="{{ route('view.login') }}" class="btn btn-secondary bg-blue-100 hover:bg-blue-200 text-blue-700 ml-5">Log In</a>
                            <a href="{{ route('view.signup') }}" class="btn btn-secondary bg-indigo-500 hover:bg-indigo-400 hidden lg:block">Sign Up</a>
                        </div>
                    @endguest
                @endif
            </div>
        </nav>
        <!-- Desktop NAV -->
        <nav class="hidden lg:flex container mx-auto p-4 justify-between items-center">
            <div class="flex items-center space-x-4">
                <div class="font-[Fremont,Verdana] font-bold text-3xl text-white">
                    @admin
                        <a href="{{ route('admin.home') }}">E-TRAK</a>
                    @endadmin
                    @user
                        <a href="{{ route('home') }}">E-TRAK</a>
                    @enduser
                    @guest
                        <a href="{{ route('home') }}">E-TRAK</a>
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
                    @admin
                        <span class="text-white text-lg border-r-2 pr-2">
                            [Admin] <b>{{ Auth::user()->name }}</b>
                        </span>
                    @endadmin
                    @user
                        <span class="text-white text-lg border-r-2 pr-2">
                            [User] <b>{{ Auth::user()->name }}</b>
                        </span>
                    @enduser
                    @auth
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <input type="submit" class="btn btn-secondary bg-blue-100 hover:bg-blue-200 text-blue-700" role="button" name="logout" value="Log Out" />
                        </form>
                    @endauth
                @else
                    <!-- Home Icon -->
                    <a href="{{ route('home') }}" class="text-white hover:bg-blue-500 border p-2 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                            <path d="M11.47 3.841a.75.75 0 0 1 1.06 0l8.69 8.69a.75.75 0 1 0 1.06-1.061l-8.689-8.69a2.25 2.25 0 0 0-3.182 0l-8.69 8.69a.75.75 0 1 0 1.061 1.06l8.69-8.689Z" />
                            <path d="m12 5.432 8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 0 1-.75-.75v-4.5a.75.75 0 0 0-.75-.75h-3a.75.75 0 0 0-.75.75V21a.75.75 0 0 1-.75.75H5.625a1.875 1.875 0 0 1-1.875-1.875v-6.198a2.29 2.29 0 0 0 .091-.086L12 5.432Z" />
                        </svg>
                    </a>
                @endif
            </div>
        </nav>
    </header>
    <div class="flex flex-1 pt-16">
        @if (!in_array(Route::currentRouteName(), $authViews))
            <!-- Sidebar Overlay -->
            <div class="fixed inset-0 z-30 md:hidden" 
                x-show="sidebarOpen" 
                @click="sidebarOpen = false" 
                x-transition.opacity>
            </div>
            <!-- Sidebar -->
            <aside class="bg-sky-200 fixed flex flex-col top-0 left-0 w-64 shadow-md p-6 h-full z-40 transform transition-transform duration-300 ease-in-out md:hidden" 
                x-show="sidebarOpen" 
                x-transition:enter="translate-x-0" 
                x-transition:leave="-translate-x-full" 
                :class="{ '-translate-x-full': !sidebarOpen, 'translate-x-0': sidebarOpen }">
                <!-- Close Button -->
                <div class="flex items-center justify-end mb-4">
                    <button class="bg-blue-400 text-white hover:bg-blue-500 border p-2 rounded-md" @click="sidebarOpen = false">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                <!-- Links -->
                <ul class="flex-1 overflow-y-auto space-y-4 pr-4 py-4">
                    @admin
                        <li>
                            <a href="{{ route('admin.home') }}" class="sidebar-link-mobile">
                                <!-- Icon -->
                                <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21H5a2 2 0 01-2-2V7h18v12a2 2 0 01-2 2z" />
                                </svg>
                                <!-- Label -->
                                <span>Home</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.dashboard') }}" class="sidebar-link-mobile">
                                <!-- Icon -->
                                <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21H5a2 2 0 01-2-2V7h18v12a2 2 0 01-2 2z" />
                                </svg>
                                <!-- Label -->
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.job-vacancies') }}" class="sidebar-link-mobile">
                                <!-- Icon -->
                                <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
                                </svg>
                                <!-- Label -->
                                <span>Job Vacancies</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.table-of-graduates') }}" class="sidebar-link-mobile">
                                <!-- Icon -->
                                <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
                                </svg>
                                <!-- Label -->
                                <span>Table of Graduates</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.via-google-sheets') }}" class="sidebar-link-mobile">
                                <!-- Icon -->
                                <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21H5a2 2 0 01-2-2V7h18v12a2 2 0 01-2 2z" />
                                </svg>
                                <!-- Label -->
                                <span>Via Google Sheets</span>
                            </a>
                        </li>
                    @endadmin
                    @user
                        <li>
                            <a href="{{ route('home') }}" class="sidebar-link-mobile">
                                <!-- Icon -->
                                <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21H5a2 2 0 01-2-2V7h18v12a2 2 0 01-2 2z" />
                                </svg>
                                <!-- Label -->
                                <span>Home</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('dashboard') }}" class="sidebar-link-mobile">
                                <!-- Icon -->
                                <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21H5a2 2 0 01-2-2V7h18v12a2 2 0 01-2 2z" />
                                </svg>
                                <!-- Label -->
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('job-vacancies') }}" class="sidebar-link-mobile">
                                <!-- Icon -->
                                <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
                                </svg>
                                <!-- Label -->
                                <span>Job Vacancies</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('table-of-graduates') }}" class="sidebar-link-mobile">
                                <!-- Icon -->
                                <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
                                </svg>
                                <!-- Label -->
                                <span>Table of Graduates</span>
                            </a>
                        </li>
                    @enduser
                    @guest
                        <li>
                            <a href="{{ route('home') }}" class="sidebar-link-mobile">
                                <!-- Icon -->
                                <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21H5a2 2 0 01-2-2V7h18v12a2 2 0 01-2 2z" />
                                </svg>
                                <!-- Label -->
                                <span>Home</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('dashboard') }}" class="sidebar-link-mobile">
                                <!-- Icon -->
                                <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21H5a2 2 0 01-2-2V7h18v12a2 2 0 01-2 2z" />
                                </svg>
                                <!-- Label -->
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('job-vacancies') }}" class="sidebar-link-mobile">
                                <!-- Icon -->
                                <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
                                </svg>
                                <!-- Label -->
                                <span>Job Vacancies</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('table-of-graduates') }}" class="sidebar-link-mobile">
                                <!-- Icon -->
                                <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
                                </svg>
                                <!-- Label -->
                                <span>Table of Graduates</span>
                            </a>
                        </li>
                    @endguest
                    <li>
                        <a href="http://www.tesda.gov.ph" target="_blank" rel="noopener noreferrer" class="sidebar-link-mobile">
                            <!-- Icon -->
                            <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <!-- Label -->
                            <span>Visit <b>TESDA</b> website</span>
                        </a>
                    </li>
                </ul>
                <!-- Bottom Section -->
                <div class="border-t border-blue-500 flex flex-col pt-3 text-center space-y-2">
                    @auth
                        @admin
                            <span class="bg-blue-500 text-white font-semibold py-2 rounded-md">[Admin] {{ Auth::user()->name }}</span>
                        @endadmin
                        @user
                            <span class="bg-blue-500 text-white font-semibold py-2 rounded-md">{{ Auth::user()->name }}</span>
                        @enduser
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <input type="submit" class="btn btn-secondary bg-blue-100 hover:bg-blue-200 text-blue-700 w-full" role="button" name="logout" value="Log Out" />
                        </form>
                    @endauth
                    @guest
                        <a href="{{ route('view.signup') }}" class="btn btn-secondary bg-indigo-500 hover:bg-indigo-400">Sign Up</a>
                        <a href="{{ route('view.login') }}" class="btn btn-secondary bg-blue-100 hover:bg-blue-200 text-blue-700">Log In</a>
                    @endguest
                </div>
            </aside>
            <!-- Sidebar (Desktop) -->
            <aside class="bg-sky-100 shadow-md fixed left-0 top-[4rem] h-[calc(100vh-4rem)] group hidden md:flex flex-col transition-all duration-300 w-20 hover:w-64 z-10">
                <ul class="space-y-4 pt-10 pb-4 px-4">
                    @admin
                        <li>
                            <a href="{{ route('admin.home') }}" class="sidebar-link">
                                <!-- Icon -->
                                <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21H5a2 2 0 01-2-2V7h18v12a2 2 0 01-2 2z" />
                                </svg>
                                <!-- Label -->
                                <span class="hidden group-hover:inline-block transition-opacity duration-200">Home</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.dashboard') }}" class="sidebar-link">
                                <!-- Icon -->
                                <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21H5a2 2 0 01-2-2V7h18v12a2 2 0 01-2 2z" />
                                </svg>
                                <!-- Label -->
                                <span class="hidden group-hover:inline-block transition-opacity duration-200">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.job-vacancies') }}" class="sidebar-link">
                                <!-- Icon -->
                                <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
                                </svg>
                                <!-- Label -->
                                <span class="hidden group-hover:inline-block transition-opacity duration-200">Job Vacancies</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.table-of-graduates') }}" class="sidebar-link">
                                <!-- Icon -->
                                <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
                                </svg>
                                <!-- Label -->
                                <span class="hidden group-hover:inline-block transition-opacity duration-200">Table of Graduates</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.via-google-sheets') }}" class="sidebar-link">
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
                            <a href="{{ route('home') }}" class="sidebar-link">
                                <!-- Icon -->
                                <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21H5a2 2 0 01-2-2V7h18v12a2 2 0 01-2 2z" />
                                </svg>
                                <!-- Label -->
                                <span class="hidden group-hover:inline-block transition-opacity duration-200">Home</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('dashboard') }}" class="sidebar-link">
                                <!-- Icon -->
                                <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21H5a2 2 0 01-2-2V7h18v12a2 2 0 01-2 2z" />
                                </svg>
                                <!-- Label -->
                                <span class="hidden group-hover:inline-block transition-opacity duration-200">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('job-vacancies') }}" class="sidebar-link">
                                <!-- Icon -->
                                <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
                                </svg>
                                <!-- Label -->
                                <span class="hidden group-hover:inline-block transition-opacity duration-200">Job Vacancies</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('table-of-graduates') }}" class="sidebar-link">
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
                            <a href="{{ route('home') }}" class="sidebar-link">
                                <!-- Icon -->
                                <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21H5a2 2 0 01-2-2V7h18v12a2 2 0 01-2 2z" />
                                </svg>
                                <!-- Label -->
                                <span class="hidden group-hover:inline-block transition-opacity duration-200">Home</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('dashboard') }}" class="sidebar-link">
                                <!-- Icon -->
                                <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21H5a2 2 0 01-2-2V7h18v12a2 2 0 01-2 2z" />
                                </svg>
                                <!-- Label -->
                                <span class="hidden group-hover:inline-block transition-opacity duration-200">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('job-vacancies') }}" class="sidebar-link">
                                <!-- Icon -->
                                <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
                                </svg>
                                <!-- Label -->
                                <span class="hidden group-hover:inline-block transition-opacity duration-200">Job Vacancies</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('table-of-graduates') }}" class="sidebar-link">
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
                        <a href="http://www.tesda.gov.ph" target="_blank" rel="noopener noreferrer" class="sidebar-link">
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
        @endif
        <!-- Main -->
        <main class="flex-1 overflow-y-auto p-6 lg:ml-20 h-[calc(100vh-4rem)] transition-all duration-300">
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