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
    <div class="overflow-x-auto bg-white shadow-md rounded-lg mb-4">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-400 text-white uppercase text-sm leading-normal">
                        <th class="px-6 py-3 text-left">Name of Company</th>
                        <th class="px-6 py-3 text-left">Contact Details</th>
                        <th class="px-6 py-3 text-left">No. of Vacancies</th>
                        <th class="px-6 py-3 text-left">Deployment Location</th>
                        @auth
                            <th class="px-6 py-3 text-left">Actions</th>    
                        @endauth
                    </tr>
                </thead>
                <tbody class="text-gray-600 font-sans">
                    @foreach ($vacancies as $vacancy)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="px-6 py-3">{{ $vacancy->company_name }}</td>
                            <td class="px-6 py-3">{{ $vacancy->contact_details }}</td>
                            <td class="px-6 py-3">{{ $vacancy->no_of_vacancies }}</td>
                            <td class="px-6 py-3">{{ $vacancy->deployment_location }}</td>
                            @auth
                                <td class="px-6 py-3 text-center">
                                    <div class="flex justify-start space-x-2">
                                        @admin
                                            {{-- <a href="{{ route('admin.view-details', $vacancy->id) }}" class="btn-sm btn-secondary font-normal">View</a>
                                            <button type="button" class="btn-sm btn-danger font-normal delete-buttons" data-value="{{ $graduate->id }}">Delete</button> --}}
                                            <a href="#" class="btn-sm btn-secondary font-normal">View</a>
                                            <button type="button" class="btn-sm btn-danger font-normal delete-buttons" data-value="#">Delete</button>
                                        @endadmin
                                        @user
                                            {{-- <a href="{{ route('view.details', $graduate->id) }}" class="btn-sm btn-secondary font-normal">View</a> --}}
                                            <a href="#" class="btn-sm btn-secondary font-normal">View</a>
                                        @enduser
                                    </div>
                                </td>
                            @endauth
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div>{{ $vacancies->withQueryString()->links('pagination::tailwind') }}</div>
    </div>
</x-layout>