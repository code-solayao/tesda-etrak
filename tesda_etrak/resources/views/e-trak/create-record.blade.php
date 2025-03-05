@section('title', 'E-TRAK - Create record')
    
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/e-trak/create-record.css') }}">
@endsection

@section('scripts')
    <script src="{{ asset('js/e-trak/create-record.js') }}"></script>
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
    $allocations = ["FY 2023", "FY 2024", "FY 2025"];
@endphp

<x-layout>
    <div class="text-center">
        <h1 class="display-4">Create an Entry</h1>
        <a href="{{ route('view-records') }}" class="btn btn-secondary" role="button">Cancel</a>
    </div>
    <div class="container mt-4">
        <form action="{{ route('create-record') }}" method="POST">
            @csrf
            {{-- VALIDATION ERRORS --}}
            @if ($errors->any()) 
                <div style="border: 5px ridge red; border-radius: 10px;" class="bg-danger bg-gradient mb-4">
                    <ul class="px-5">
                        @foreach ($errors as $error)
                            <li class="my-3 text-white fw-bolder">
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!-- FULL NAME -->
            <div class="form-group mb-4">
                <label for="last_name" class="form-label control-label-1">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name') }}" placeholder="Enter last name" required>
            </div>
            <div class="form-group mb-4">
                <label for="first_name" class="form-label control-label-1">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name') }}" placeholder="Enter first name" required>
            </div>
            <div class="form-group mb-4">
                <label for="middle_name" class="form-label control-label-1">Middle Name</label>
                <input type="text" class="form-control" id="middle_name" name="middle_name" value="{{ old('middle_name') }}" placeholder="Enter middle name">
            </div>
            <div class="form-group mb-5">
                <label for="extension_name" class="form-label control-label-1">Extension Name</label>
                <select name="extension_name" id="extension_name" class="form-control">
                    <option value="">-- Select an extension name --</option>
                    @foreach ($extension_names as $name)
                        <option value="{{ $name }}" {{ old('extension_name') == $name ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <!-- INITIAL DATA -->
            <div class="form-group mb-3">
                <label class="form-label control-label-1">Sex</label>
                <div>
                    <input type="radio" class="form-check-input" id="male" name="sex" value="Male" {{ old('sex') == "Male" ? 'checked' : '' }}>
                    <label for="male" class="form-label">Male</label>
                    <br>
                    <input type="radio" class="form-check-input" id="female" name="sex" value="Female" {{ old('sex') == "Female" ? 'checked' : '' }}>
                    <label for="female" class="form-label">Female</label>
                </div>
            </div>
            <div class="form-group mb-4">
                <label for="birthdate" class="form-label control-label-1">Date of Birth</label>
                <input type="date" class="form-control" id="birthdate" name="birthdate" value="{{ old('birthdate') }}">
            </div>
            <div class="form-group mb-4">
                <label for="contact_number" class="form-label control-label-1">Contact Number</label>
                <input type="text" class="form-control" id="contact_number" name="contact_number" value="{{ old('contact_number') }}" minlength="13" maxlength="16" placeholder="0900-000-0000">
            </div>
            <div class="form-group mb-4">
                <label for="address" class="form-label control-label-1">Address</label>
                <textarea name="address" id="address" class="form-control" rows="5">{{ old('address') }}</textarea>
            </div>
            <div class="form-group mb-4">
                <label for="email" class="form-label control-label-1">E-mail Address</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="username@email.com">
            </div>
            <div class="form-group mb-4">
                <label for="sector" class="form-label control-label-1">Sector</label>
                <select name="sector" id="sector" class="form-control">
                    <option value="">-- Select a sector --</option>
                    @foreach ($sectors as $sector)
                        <option value="{{ $sector }}" {{ old('sector') == $sector ? 'selected' : '' }}>{{ $sector }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-4">
                <label for="qualification_title" class="form-label control-label-1">Qualification Title</label>
                <input type="text" class="form-control" id="qualification_title" name="qualification_title" value="{{ old('qualification_title') }}">
            </div>
            <div class="form-group mb-4">
                <label for="selectDistrict" class="form-label control-label-1">District</label>
                <select name="district" id="selectDistrict" class="form-control">
                    <option value="">-- Select a district --</option>
                    @foreach ($districts as $district)
                        <option value="{{ $district }}" {{ old('district') == $district ? 'selected' : '' }}>{{ $district }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-4">
                <label for="selectCity" class="form-label control-label-1">City</label>
                <select name="city" id="selectCity" class="form-control">
                    <option value="">-- Select a city --</option>
                    @foreach ($cities as $city)
                        <option value="{{ $city }}" {{ old('city') == $city ? 'selected' : '' }}>{{ $city }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-4">
                <label for="scholarship_type" class="form-label control-label-1">Type of Scholarship</label>
                <select name="scholarship_type" id="scholarship_type" class="form-control">
                    <option value="">-- Select a scholarship type --</option>
                    @foreach ($scholarship_types as $type)
                        <option value="{{ $type }}" {{ old('scholarship_type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-4">
                <label for="tvi" class="form-label control-label-1">Name of TVI</label>
                <input type="text" class="form-control" id="tvi" name="tvi" value="{{ old('tvi') }}">
            </div>
            <div class="form-group mb-3">
                <label for="allocation" class="form-label control-label-1">Year of Graduation</label>
                <select name="allocation" id="allocation" class="form-control">
                    <option value="">-- Select a graduation year --</option>
                    @foreach ($allocations as $allocation)
                        <option value="{{ $allocation }}" {{ old('allocation') == $allocation ? 'selected' : '' }}>{{ $allocation }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <!-- <input type="submit" class="btn btn-primary" name="submit" value="Confirm" role="button" /> -->
                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#submitRecordModal">Submit</button>
                <a href="{{ route('view-records') }}" class="btn btn-secondary" role="button">Cancel</a>
            </div>
            <!-- Modal -->
            <div class="modal" id="submitRecordModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Submit Record</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Once this record is submitted, changes or updates for this information will never be possible. Do you wish to confirm this?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" role="button" name="submit" value="Confirm">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-layout>