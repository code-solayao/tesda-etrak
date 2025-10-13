@section('title', 'E-TRAK - Create an account')

@section('vite')
    @vite(['resources/css/app.css', 'resources/js/app.js']);
@endsection

<x-layout>
    <div class="flex items-start justify-between">
        <div class="space-y-8">
            <div class="flex items-center justify-start mt-auto space-x-10">
                <img src="{{ asset('images/logo_default.png') }}" alt="E-TRAK Logo" class="w-3xs">
                <div>
                    <h1 class="mb-2">Welcome to E-TRAK</h1>
                    <p class="text-2xl">This is a project of <strong>Employment Monitoring System</strong></p>
                </div>
            </div>
            <div>
                <video class="border mr-auto rounded shadow-md w-4xl" autoplay controls muted>
                    <source src="{{ asset('videos/index.webm') }}" type="video/webm">
                    <source src="{{ asset('videos/index.mp4') }}" type="video/mp4">
                    <source src="{{ asset('videos/index.ogg') }}" type="video/ogg">
                    Your browser does not support HTML video.
                </video>
            </div>
        </div>
        <div class="flex items-baseline justify-end">
            <div class="bg-sky-300 fixed flex items-center justify-center h-[800px] rounded-2xl shadow-lg">
                <div class="w-sm p-8 space-y-6">
                    <div class="border-b border-b-blue-500 p-2">
                        <h2 class="text-blue-600 text-2xl text-center font-bold">Create an account</h2>
                    </div>
                    @if ($errors->any())
                        <ul class="px-3 py-2 bg-red-400 rounded-md">
                            @foreach ($errors->all() as $error)
                                <li class="text-md text-white">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <form action="{{ route('signup') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <input type="text" name="name" 
                            class="w-full px-4 py-2 mt-1 text-gray-800 bg-gray-100 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                            placeholder="Username" required autofocus />
                        </div>
                        <div>
                            <input type="email" name="email" 
                            class="w-full px-4 py-2 mt-1 text-gray-800 bg-gray-100 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                            placeholder="E-mail" required />
                        </div>
                        <div>
                            <input type="password" name="password" 
                            class="w-full px-4 py-2 mt-1 text-gray-800 bg-gray-100 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                            placeholder="Password" required />
                        </div>
                        <div>
                            <input type="password" name="password_confirmation" 
                            class="w-full px-4 py-2 mt-1 text-gray-800 bg-gray-100 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                            placeholder="Confirm Password" required />
                        </div>
                        <div>
                            <input type="submit" name="signup" value="Sign Up" 
                            class="w-full px-4 py-2 font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500" />
                        </div>
                    </form>
                    <div>
                        <p class="text-sm text-center text-gray-700">
                            Return to <a href="{{ route('view.login') }}" class="text-blue-700 hover:underline">login</a>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="border-4 border-gray-200 flex items-center justify-center my-12 py-6 rounded-2xl shadow-lg space-x-28 w-3/4">
        <img src="{{ asset('images/logo_tesda.png') }}" alt="TESDA Logo" class="w-48">
        <img src="{{ asset('images/logo_bagong-pilipinas.png') }}" alt="Bagong Pilipinas Logo" class="w-48">
        <img src="{{ asset('images/logo_dps-2025.png') }}" alt="DPS Registration Seal 2025" class="w-48">
        <img src="{{ asset('images/logo_kayang-kaya.png') }}" alt="Kayang-Kaya Logo" class="w-48">
    </div>
</x-layout>