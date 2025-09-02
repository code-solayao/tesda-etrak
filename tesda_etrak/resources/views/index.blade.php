@section('vite')
    @vite(['resources/css/app.css', 'resources/js/app.js']);
@endsection

<x-layout>
    <div class="text-center mb-10">
        <img src="{{ asset('images/logo.png') }}" alt="TESDA Logo" class="block ml-auto mr-auto" width="200" height="200">
        <h1 class="mb-2">Welcome to E-TRAK</h1>
        <p class="text-2xl">This is a project of <strong>Employment Monitoring System</strong></p>
    </div>
</x-layout>