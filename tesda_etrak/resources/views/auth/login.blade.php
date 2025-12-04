@section('title', 'E-TRAK - Sign in')

@section('vite')
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/auth/login.js']);
@endsection

<x-layout>
    <div x-data="{ open: false }">
        <!-- Toggle Button -->
        <button @click="open = true" 
            class="px-4 py-2 bg-blue-600 text-white rounded-lg">
            <span>Login</span>
        </button>
        <!-- Background Overlay -->
        <div class="fixed inset-0 bg-black/50 z-40 pointer-events-auto"
            x-show="open"
            @click="open = false"
            x-transition.opacity>
        </div>
        <!-- Floating Login Panel -->
        <div class="bg-blue-100 absolute right-0 mt-2 w-80 shadow-xl rounded-lg p-6 z-50 border border-gray-200"
            x-show="open"
            x-transition>
            <h2 class="text-2xl font-semibold mb-4 text-center">Login</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <!-- Email -->
                <div class="mb-3">
                    <label class="block text-sm font-medium">Email</label>
                    <input type="email" name="email" required
                        class="w-full mt-1 p-2 border rounded-lg focus:ring focus:ring-blue-300">
                </div>
                <!-- Password -->
                <div class="mb-4">
                    <label class="block text-sm font-medium">Password</label>
                    <input type="password" name="password" required
                        class="w-full mt-1 p-2 border rounded-lg focus:ring focus:ring-blue-300">
                </div>
                <!-- Submit -->
                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg">
                    Login
                </button>
                <!-- Close Button -->
                <button 
                    type="button"
                    @click="open = false"
                    class="w-full mt-3 text-center text-gray-600 hover:underline text-sm">
                    Close
                </button>
            </form>
        </div>
    </div>
    <section class="block sm:flex flex-row-reverse items-start justify-between">
        <div id="loginForm">
            <section class="sm:hidden flex items-baseline justify-baseline">
                <div class="bg-sky-300 fixed flex items-center justify-center rounded-2xl shadow-lg w-[calc(60vh-3rem)] h-[calc(100vh-9.8rem)]">
                    <div class="w-sm p-8 space-y-6">
                        <div class="border-b border-b-blue-500 p-2">
                            <h2 class="text-blue-600 text-2xl text-center font-bold">Sign in</h2>
                        </div>
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
                            <div>
                                <input type="submit" name="login" value="Sign In" 
                                class="w-full px-4 py-2 font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500" />
                            </div>
                        </form>
                        <div>
                            <p class="text-sm text-center text-gray-700">
                                Create an account <a href="{{ route('view.signup') }}" class="text-blue-700 hover:underline">here</a>.
                            </p>
                        </div>
                    </div>
                </div>
            </section>
            <section class="bg-blue-100 border-gray-200 border fixed p-8 right-10 rounded-2xl shadow-lg w-sm z-50"
                x-show="open"
                x-transition>
                <div class="border-b border-b-blue-500 p-2">
                    <h2 class="text-blue-600 text-2xl font-semibold mb-4 text-center">Sign in</h2>
                </div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <!-- Email -->
                    <div class="mb-3">
                        <label class="block text-sm font-medium">Email</label>
                        <input type="email" name="email" required
                            class="w-full mt-1 p-2 border rounded-lg focus:ring focus:ring-blue-300">
                    </div>
                    <!-- Password -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Password</label>
                        <input type="password" name="password" required
                            class="w-full mt-1 p-2 border rounded-lg focus:ring focus:ring-blue-300">
                    </div>
                    <!-- Submit -->
                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg">
                        Login
                    </button>
                    <!-- Close Button -->
                    <button 
                        type="button"
                        @click="open = false"
                        class="w-full mt-3 text-center text-gray-600 hover:underline text-sm">
                        Close
                    </button>
                </form>
            </section>
            <section class="hidden sm:hidden items-baseline justify-end">
                <div class="bg-sky-300 fixed flex items-center justify-center h-[800px] rounded-2xl shadow-lg">
                    <div class="w-sm p-8 space-y-6">
                        <div class="border-b border-b-blue-500 p-2">
                            <h2 class="text-blue-600 text-2xl text-center font-bold">Sign in</h2>
                        </div>
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
                            <div>
                                <input type="submit" name="login" value="Sign In" 
                                class="w-full px-4 py-2 font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500" />
                            </div>
                        </form>
                        <div>
                            <p class="text-sm text-center text-gray-700">
                                Create an account <a href="{{ route('view.signup') }}" class="text-blue-700 hover:underline">here</a>.
                            </p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div id="title z-10">
            <section class="space-y-8 sm:hidden">
                <div class="text-center space-x-10">
                    <img src="{{ asset('images/logo_default.png') }}" alt="E-TRAK Logo" class="mx-auto w-3xs">
                    <div>
                        <h3 class="text-4xl font-bold mb-2">Welcome to E-TRAK</h3>
                        <p class="text-xl">This is a project of <strong>Employment Monitoring System</strong></p>
                    </div>
                </div>
                <video class="border rounded shadow-md" autoplay controls muted>
                    <source src="{{ asset('videos/index.webm') }}" type="video/webm">
                    <source src="{{ asset('videos/index.mp4') }}" type="video/mp4">
                    <source src="{{ asset('videos/index.ogg') }}" type="video/ogg">
                    Your browser does not support HTML video.
                </video>
            </section>
            <section class="space-y-8 hidden sm:block">
                <div class="flex items-center justify-start mt-auto space-x-10">
                    <img src="{{ asset('images/logo_default.png') }}" alt="E-TRAK Logo" class="w-3xs">
                    <div>
                        <h1 class="mb-2">Welcome to E-TRAK</h1>
                        <p class="text-2xl">This is a project of <strong>Employment Monitoring System</strong></p>
                    </div>
                </div>
                <video class="border mr-auto rounded shadow-md w-4xl" autoplay controls muted>
                    <source src="{{ asset('videos/index.webm') }}" type="video/webm">
                    <source src="{{ asset('videos/index.mp4') }}" type="video/mp4">
                    <source src="{{ asset('videos/index.ogg') }}" type="video/ogg">
                    Your browser does not support HTML video.
                </video>
            </section>
        </div>
    </section>
    <section class="my-12">
        <div class="border-gray-200 border-4 flex sm:flex-col items-center justify-center p-6 rounded-2xl shadow-lg space-x-12 sm:space-x-28 sm:w-3/4">
            <div class="mx-auto mb-16 space-y-20 sm:hidden">
                <div class="flex items-center justify-center">
                    <img src="{{ asset('images/logo_tesda.png') }}" alt="TESDA Logo" class="w-28 object-contain">
                </div>
                <div class="flex items-center justify-center">
                    <img src="{{ asset('images/logo_kayang-kaya.png') }}" alt="Kayang-Kaya Logo" class="w-24 object-contain">
                </div>
            </div>
            <div class="mx-auto space-y-8 sm:hidden">
                <div class="flex items-center justify-center">
                    <img src="{{ asset('images/logo_bagong-pilipinas.png') }}" alt="Bagong Pilipinas Logo" class="w-28 object-contain">
                </div>
                <div class="flex items-center justify-center">
                    <img src="{{ asset('images/logo_dps-2025.png') }}" alt="DPS Registration 2025 Seal" class="w-40 object-contain">
                </div>
            </div>
            <div class="hidden sm:flex items-center justify-center space-x-28">
                <div class="flex items-center justify-center">
                    <img src="{{ asset('images/logo_tesda.png') }}" alt="TESDA Logo" class="w-48 object-contain">
                </div>
                <div class="flex items-center justify-center">
                    <img src="{{ asset('images/logo_bagong-pilipinas.png') }}" alt="Bagong Pilipinas Logo" class="w-48 object-contain">
                </div>
                <div class="flex items-center justify-center">
                    <img src="{{ asset('images/logo_kayang-kaya.png') }}" alt="Kayang-Kaya Logo" class="w-48 object-contain">
                </div>
                <div class="flex items-center justify-center">
                    <img src="{{ asset('images/logo_dps-2025.png') }}" alt="DPS Registration 2025 Seal" class="w-48 object-contain">
                </div>
            </div>
        </div>
    </section>
</x-layout>