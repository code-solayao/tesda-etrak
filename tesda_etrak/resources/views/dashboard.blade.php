@section('title', 'E-TRAK - Dashboard')

@section('vite')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@endsection

@section('main', 'Dashboard')

<x-layout>
    <div class="mb-4">
        <a href="https://lookerstudio.google.com/u/0/reporting/9d6c7c0a-dcfb-4dda-ba67-589c230b57bd/page/GzuKE" 
        target="_blank" rel="noopener noreferrer" class="btn btn-primary" role="button">
            View dashboard in Google Looker Studio
        </a>
    </div>
    <div class="max-w-full mx-auto p-4 sm:px-4 lg:px-8">
        <div class="rounded-xl shadow-md overflow-hidden border border-black">
            <iframe src="https://lookerstudio.google.com/embed/reporting/9d6c7c0a-dcfb-4dda-ba67-589c230b57bd/page/GzuKE" 
            frameborder="0" class="w-full h-dvh" allowfullscreen 
            sandbox="allow-storage-access-by-user-activation allow-scripts allow-same-origin allow-popups allow-popups-to-escape-sandbox">
            </iframe>
        </div>
    </div>
</x-layout>