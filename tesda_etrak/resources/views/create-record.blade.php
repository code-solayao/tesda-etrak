@section('title', 'E-TRAK - Create record')

@section('vite')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@endsection

@php
    $extension_names = ["Sr.", "Jr.", "III"];
    $sectors = [
        "Agriculture", "ALT", "Construction", "Electrical and Electronics", "Garments", "Health", "HVAC/R", "ICT", "Marine", 
        "Metals and Engineering", "Others", "Processed Foods and Beverages", "SCDOS", "Tourism", "TVET", "Visual Arts", "Wholesale"
    ];
    $districts = [
        "CaMaNaVa", "Manila", "MuntiParLasTaPat", "PaMaMariSan", "Pasay-Makati", "Quezon City"
    ];
    $cities = [
        "Caloocan City", "Malabon City", "Navotas City", "Valenzuela City", "Manila", 
        "Las Piñas City", "Muntinlupa City", "Parañaque City", "Pateros", "Taguig City", 
        "Mandaluyong City", "Marikina City", "Pasig City", "San Juan City", 
        "Makati City", "Pasay City", "Quezon City"
    ];
    $scholarship_types = [
        "STEP", "TWSP", "PESFA", "TTSP", "UAQTEA", "TSUPER Iskolar"
    ];
    $graduation_years = ["2023", "2024", "2025"];
    $allocations = ["FY 2023", "FY 2024", "FY 2025"];
@endphp

<x-layout>
    <div class="mx-auto mt-10 bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-gray-700 mb-10">Create an Entry</h1>
        <form action="{{ route('create') }}" method="POST" class="space-y-6">
            @csrf
            {{-- FULL NAME --}}
            <div>
                <label for="last_name" class="form-label">Last name</label>
                <input type="text" name="last_name" id="last_name" class="form-input" value="{{ old('last_name') }}" autofocus />
            </div>
            <div>
                <label for="first_name" class="form-label">First name</label>
                <input type="text" name="first_name" id="first_name" class="form-input" value="{{ old('first_name') }}" />
            </div>
            <div>
                <label for="middle_name" class="form-label">Middle name</label>
                <input type="text" name="middle_name" id="middle_name" class="form-input" value="{{ old('middle_name') }}" />
            </div>
            <div>
                <label for="extension_name" class="form-label">Extension name</label>
                <select name="extension_name" id="extension_name" class="form-input">
                    <option value="">-- Select an extension name --</option>
                    @foreach ($extension_names as $name)
                        <option value="{{ $name }}" {{ old('extension_name') == $name ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            {{-- INITIAL DATA --}}
            <div>
                <label class="form-label">Sex</label>
                <div class="mt-2 space-y-2">
                    <label for="male" class="flex items-center">
                        <input type="radio" name="sex" id="male" value="Male" class="text-blue-500 border-gray-300 focus:ring-blue-500">
                        <span class="ml-2 text-gray-700">Male</span>
                    </label>
                    <label for="female" class="flex items-center">
                        <input type="radio" name="sex" id="female" value="Female" class="text-blue-500 border-gray-300 focus:ring-blue-500">
                        <span class="ml-2 text-gray-700">Female</span>
                    </label>
                </div>
            </div>
            <div class="flex items-center justify-between">
                <input type="submit" class="btn btn-primary rounded-lg" name="create" value="Create" role="button" />
            </div>
        </form>
    </div>
</x-layout>