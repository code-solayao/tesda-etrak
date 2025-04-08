@section('title', 'E-TRAK - Dashboard')

@section('vite')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@endsection

@section('main', 'Dashboard')

<x-layout>
    <div class="text-center">
        <iframe src="https://datastudio.google.com/embed/reporting/12345/page/1" 
        frameborder="0" class="w-full min-h-screen border" allowfullscreen></iframe>
    </div>
</x-layout>