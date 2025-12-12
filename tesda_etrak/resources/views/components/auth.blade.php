<x-layout>
    <section class="block sm:flex flex-row-reverse items-start justify-between">
        {{ $slot }}
        <div id="title">
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