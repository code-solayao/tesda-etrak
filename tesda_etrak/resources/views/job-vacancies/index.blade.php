@section('title', 'E-TRAK - Job Vacancies')

@section('vite')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@endsection

@section('main', 'Job Vacancies')

@php
    $categories = [
        "Name of Company", 
        "Contact Details", 
        "No. of Vacancies", 
        "Deployment Location",
    ];
@endphp

<x-layout>
    @auth
        <div class="flex items-center justify-baseline mb-4">
            <form action="{{ route('admin.search-vacancies') }}" method="GET" class="flex justify-baseline w-1/2">
                <input type="text" class="bg-white border px-2 py-1 rounded w-1/2" name="search" value="{{ $search }}" placeholder="Search vacancy..." />
                <select name="search_category" class="bg-gray-300 border ml-1 px-2 py-1 rounded w-1/2">
                    <option value="">-- Select a category --</option>
                    @foreach ($categories as $category)
                        <option class="bg-gray-50" value="{{ $category }}" {{ $search_category == $category ? 'selected' : '' }}>{{ $category }}</option>
                    @endforeach
                </select>
            </form>
            @admin
                <div class="ml-auto">
                    <form action="{{ route('import.vacancies.data') }}" method="GET" class="inline-block">
                        <input type="submit" value="Import Data" class="btn btn-primary" />
                    </form>
                    <a href="https://docs.google.com/spreadsheets/d/100jOk-835-aRxURFWkON1026rLkBKH8Rrwtdy8ojv6Q/edit?gid=250953884#gid=250953884" 
                    target="_blank" rel="noopener noreferrer" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="size-3.5 inline-block mb-1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                        </svg>
                    </a>
                </div>
            @endadmin
        </div>
    @endauth 
    <div class="flex items-center justify-center space-x-2">
        <section class="bg-gray-300 p-6 lg:p-8 rounded-lg lg:rounded-xl w-full lg:w-full">
            <div class="max-w-full mx-auto h-[calc(2.9*10rem)] lg:h-[calc(3.8*10rem)] overflow-y-auto pr-2">
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach ($vacancies as $vacancy)
                        <a href="#" class="group bg-gray-100 hover:bg-white border border-gray-300 p-4 rounded-lg lg:rounded-xl shadow-sm text-center transition">
                            <!-- Company Logo -->
                            <div class="flex items-center justify-center mb-4">
                                <img src="{{ asset('images/logo.png') }}" alt="{{ $vacancy->company_name }}" class="h-full max-h-12 object-contain">
                            </div>
                            <!-- Company Name -->
                            <h3 class="font-semibold text-md text-gray-800 truncate">{{ $vacancy->company_name }}</h3>
                            <!-- Job Count -->
                            @if ($vacancy->no_of_vacancies != null)
                                <span class="text-sm text-gray-500 mt-1">{{ $vacancy->no_of_vacancies }} vacancies</span>
                            @else
                                <span class="text-sm text-gray-500 mt-1">Unspecified</span>
                            @endif
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
        <section class="bg-gray-100 border border-gray-400 hidden lg:block p-8 rounded-xl shadow-md w-full">
            <div class="h-[calc(3.8*10rem)] max-w-full mx-auto overflow-y-auto">
                <!-- Company Logo -->
                <div class="flex items-center justify-start mb-4">
                    <img src="{{ asset('images/logo.png') }}" alt="Company Logo" class="max-w-24 w-full object-contain">
                </div>
                <h2 class="font-semibold text-5xl">Company Name</h2>
            </div>
        </section>
    </div>
</x-layout>