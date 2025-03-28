@section('title', 'E-TRAK - View records')

@section('vite')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@endsection

@php
    $categories = [
        "Record number", 
        "Last name", 
        "First name", 
        "Middle name", 
        "Extension name", 
        "Status of Employment", 
        "Year of Graduation", 
        "Qualification Title", 
    ];
@endphp

<x-layout>
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-semibold mb-4">Data Records</h2>
        <form action="{{ route('search-graduates') }}" method="GET">
            <div class="mb-4 flex justify-baseline items-center">
                <input type="text" class="border bg-white px-2 py-1 rounded w-1/3" name="search" value="{{ $search }}" placeholder="Search record..." />
                <select name="search_category" class="border bg-gray-300 px-2 py-1 ml-1 rounded w-lg inline">
                    <option value="">-- Select a category --</option>
                    @foreach ($categories as $category)
                        <option class="bg-gray-50" value="{{ $category }}" {{ $search_category == $category ? 'selected' : '' }}>{{ $category }}</option>
                    @endforeach
                </select>
                <a href="#" class="btn btn-danger ml-auto">Clear All Records</a>
            </div>
        </form>
        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-400 text-white uppercase text-sm leading-normal">
                        <th class="px-6 py-3 text-left">No.</th>
                        <th class="px-6 py-3 text-left">Last name</th>
                        <th class="px-6 py-3 text-left">First name</th>
                        <th class="px-6 py-3 text-left">Middle name</th>
                        <th class="px-6 py-3 text-left">Ext.</th>
                        <th class="px-6 py-3 text-left">Status of Employment</th>
                        <th class="px-6 py-3 text-left">Year of Graduation</th>
                        <th class="px-6 py-3 text-left">Qualification Title</th>
                        <th class="px-6 py-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 font-sans">
                    @foreach ($graduates as $graduate)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="px-6 py-3">{{ $graduate->id }}</td>
                            <td class="px-6 py-3">{{ $graduate->last_name }}</td>
                            <td class="px-6 py-3">{{ $graduate->first_name }}</td>
                            <td class="px-6 py-3">{{ $graduate->middle_name }}</td>
                            <td class="px-6 py-3">{{ $graduate->extension_name }}</td>
                            <td class="px-6 py-3">{{ $graduate->employment_status }}</td>
                            <td class="px-6 py-3">{{ $graduate->allocation }}</td>
                            <td class="px-6 py-3">{{ $graduate->qualification_title }}</td>
                            <td class="px-6 py-3 text-center">
                                <div class="flex justify-center space-x-2">
                                    <a href="#" class="btn-sm btn-secondary font-normal">View</a>
                                    <form action="" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" class="btn-sm btn-danger font-normal" value="Delete" />
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">{{ $graduates->withQueryString()->links() }}</div>
    </div>
</x-layout>