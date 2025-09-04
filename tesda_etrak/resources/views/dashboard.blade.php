@section('title', 'E-TRAK - Dashboard')

@section('vite')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@endsection

@section('main', 'Dashboard')

<x-layout>
    <div class="mb-4">
        @admin
            <a href="https://lookerstudio.google.com/u/0/reporting/9d6c7c0a-dcfb-4dda-ba67-589c230b57bd/page/GzuKE" 
            target="_blank" rel="noopener noreferrer" class="btn btn-primary" role="button">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 inline-block mb-1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                </svg> View in Google Looker Studio
            </a>
        @endadmin
    </div>
    <div class="max-w-full mx-auto p-4 sm:px-4 lg:px-8">
        <div class="rounded-xl shadow-md overflow-hidden border border-black">
            <iframe src="https://lookerstudio.google.com/embed/reporting/9d6c7c0a-dcfb-4dda-ba67-589c230b57bd/page/GzuKE" 
            frameborder="0" class="w-full h-dvw lg:h-dvh" allowfullscreen 
            sandbox="allow-storage-access-by-user-activation allow-scripts allow-same-origin allow-popups allow-popups-to-escape-sandbox">
            </iframe>
        </div>
    </div>
</x-layout>