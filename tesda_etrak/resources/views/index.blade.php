@section('vite')
    @vite(['resources/css/app.css', 'resources/js/app.js']);
@endsection

<x-layout>
    <div class="lg:hidden mb-10 text-center">
        <img src="{{ asset('images/logo_default.png') }}" alt="E-TRAK Logo" class="mx-auto w-1/2">
        <h1 class="mb-2 text-4xl">Welcome to E-TRAK</h1>
        <p class="text-xl">This is a project of <strong>Employment Monitoring System</strong></p>
    </div>
    <div class="lg:flex hidden items-center justify-baseline mb-10">
        <div class="mt-auto">
            <img src="{{ asset('images/logo_default.png') }}" alt="E-TRAK Logo" class="w-3xs">
            <h1 class="mb-2">Welcome to E-TRAK</h1>
            <p class="text-2xl">This is a project of <strong>Employment Monitoring System</strong></p>
        </div>
        <div class="border rounded-md shadow-md mb-auto ml-auto">
            <video class="rounded w-xl" autoplay controls muted>
                <source src="{{ asset('videos/index.webm') }}" type="video/webm">
                <source src="{{ asset('videos/index.mp4') }}" type="video/mp4">
                <source src="{{ asset('videos/index.ogg') }}" type="video/ogg">
                Your browser does not support HTML video.
            </video>
        </div>
    </div>
    <div class="flex items-center justify-center mx-auto py-32 space-x-32">
        <img src="{{ asset('images/logo_tesda.png') }}" alt="TESDA Logo" class="w-2xs">
        <img src="{{ asset('images/logo_kayang-kaya.png') }}" alt="Kayang-Kaya Logo" class="w-2xs">
        <img src="{{ asset('images/logo_bagong-pilipinas.png') }}" alt="Bagong Pilipinas Logo" class="w-2xs">
    </div>
</x-layout>