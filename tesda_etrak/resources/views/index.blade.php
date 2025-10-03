@section('vite')
    @vite(['resources/css/app.css', 'resources/js/app.js']);
@endsection

<x-layout>
    <div class="lg:hidden mb-10 text-center">
        <img src="{{ asset('images/logo_default.png') }}" alt="E-TRAK Logo" class="mx-auto w-1/2">
        <h1 class="mb-2 text-4xl">Welcome to E-TRAK</h1>
        <p class="text-xl">This is a project of <strong>Employment Monitoring System</strong></p>
    </div>
    <div class="lg:block hidden space-y-8">
        <div class="flex items-center justify-start mt-auto space-x-10">
            <img src="{{ asset('images/logo_default.png') }}" alt="E-TRAK Logo" class="w-3xs">
            <div>
                <h1 class="mb-2">Welcome to E-TRAK</h1>
                <p class="text-2xl">This is a project of <strong>Employment Monitoring System</strong></p>
            </div>
        </div>
        <div>
            <video class="border mx-auto rounded shadow-md w-4xl" autoplay controls muted>
                <source src="{{ asset('videos/index.webm') }}" type="video/webm">
                <source src="{{ asset('videos/index.mp4') }}" type="video/mp4">
                <source src="{{ asset('videos/index.ogg') }}" type="video/ogg">
                Your browser does not support HTML video.
            </video>
        </div>
    </div>
    <div class="border-4 border-gray-200 flex items-center justify-center mx-24 my-12 py-6 rounded-2xl shadow-lg space-x-60">
        <img src="{{ asset('images/logo_tesda.png') }}" alt="TESDA Logo" class="w-48">
        <img src="{{ asset('images/logo_bagong-pilipinas.png') }}" alt="Bagong Pilipinas Logo" class="w-48">
        <img src="{{ asset('images/logo_dps-2025.png') }}" alt="DPS Registration Seal 2025" class="w-48">
        <img src="{{ asset('images/logo_kayang-kaya.png') }}" alt="Kayang-Kaya Logo" class="w-48">
    </div>
</x-layout>