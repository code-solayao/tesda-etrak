@section('vite')
    @vite(['resources/css/app.css', 'resources/js/app.js']);
@endsection

<x-layout>
    <div class="lg:hidden mb-10 text-center">
        <img src="{{ asset('images/logo.png') }}" alt="TESDA Logo" class="mx-auto w-1/2">
        <h1 class="mb-2 text-4xl">Welcome to E-TRAK</h1>
        <p class="text-xl">This is a project of <strong>Employment Monitoring System</strong></p>
    </div>
    <div class="lg:block hidden mb-10 text-center">
        <img src="{{ asset('images/logo.png') }}" alt="TESDA Logo" class="mx-auto w-3xs">
        <h1 class="mb-2">Welcome to E-TRAK</h1>
        <p class="text-2xl">This is a project of <strong>Employment Monitoring System</strong></p>
    </div>
</x-layout>