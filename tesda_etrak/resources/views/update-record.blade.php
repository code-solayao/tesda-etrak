@section('title', 'E-TRAK - Update record')

@section('vite')
    @vite(['resources/css/app.css', 
    'resources/js/app.js', 
    'resources/js/e-trak/update-record.js'
    ])
@endsection

@section('main', 'Update Record')

@php
    $verification_means = [
        "For Verification", "E-mail", "Phone (SMS & Call)", "Phone and E-mail"
    ];
    $not_hired_reasons = [
        "Underage", "Upskilling", "Lack of Experience", "Did not meet the requirements"
    ];
@endphp

<x-layout>
    <div class="mx-auto bg-white p-8 rounded-lg shadow-md">
        <div class="mb-5">
            <a href="{{ route('view.details', $graduate->id) }}" class="btn btn-secondary rounded-lg">Cancel</a>
        </div>
        @if ($errors->any())
            <ul class="px-3 py-2 bg-red-400 rounded-md mb-5">
                @foreach ($errors->all() as $error)
                    <li class="text-md text-white">{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <div class="w-full">
            <div class="flex border-b" id="tabs">
                <button class="px-4 py-2 border-b-2 border-black" id="detailsTab">Details</button>
                <button class="px-4 py-2 border-b-2 border-transparent hover:border-gray-300" id="verificationTab">Verification</button>
                <button class="px-4 py-2 border-b-2 border-transparent hover:border-gray-300" id="employmentTab">Employment</button>
            </div>
        </div>
        <div class="p-4">
            <form action="#" method="POST">
                @csrf
                @method('PUT')
                <div class="tab-content">
                    <fieldset disabled>
                        {{-- FULL NAME --}}
                        <div class="mb-5">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" name="last_name" id="last_name" class="form-input bg-gray-200" value="{{ $graduate->last_name }}" />
                        </div>
                        <div class="mb-5">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" name="first_name" id="first_name" class="form-input bg-gray-200" value="{{ $graduate->first_name }}" />
                        </div>
                        <div class="mb-5">
                            <label for="middle_name" class="form-label">Middle Name</label>
                            <input type="text" name="middle_name" id="middle_name" class="form-input bg-gray-200" value="{{ $graduate->middle_name }}" />
                        </div>
                        <div class="mb-5">
                            <label for="extension_name" class="form-label">Extension Name</label>
                            <input type="text" name="extension_name" id="extension_name" class="form-input bg-gray-200" value="{{ $graduate->extension_name }}" />
                        </div>
                        {{-- INITIAL DATA --}}
                        <div class="mb-5">
                            <label for="sex" class="form-label">Sex</label>
                            <input type="text" name="sex" id="sex" class="form-input bg-gray-200" value="{{ $graduate->sex }}" />
                        </div>
                        <div class="mb-5">
                            <label for="birthdate" class="form-label">Date of Birth</label>
                            <input type="text" name="birthdate" id="birthdate" class="form-input bg-gray-200 dateFormat" value="{{ $graduate->birthdate }}" />
                        </div>
                        <div class="mb-5">
                            <label for="contact_number" class="form-label">Contact Number</label>
                            <input type="text" name="contact_number" id="contact_number" class="form-input bg-gray-200" value="{{ $graduate->contact_number }}" />
                        </div>
                        <div class="mb-5">
                            <label for="address" class="form-label">Address</label>
                            <textarea name="address" id="address" rows="3" class="form-input bg-gray-200">{{ $graduate->address }}</textarea>
                        </div>
                        <div class="mb-5">
                            <label for="email" class="form-label">E-mail Address</label>
                            <input type="text" name="email" id="email" class="form-input bg-gray-200" value="{{ $graduate->email }}" />
                        </div>
                        <div class="mb-5">
                            <label for="sector" class="form-label">Sector</label>
                            <input type="text" name="sector" id="sector" class="form-input bg-gray-200" value="{{ $graduate->sector }}" />
                        </div>
                        <div class="mb-5">
                            <label for="qualification_title" class="form-label">Qualification Title</label>
                            <input type="text" name="qualification_title" id="qualification_title" class="form-input bg-gray-200" value="{{ $graduate->qualification_title }}" />
                        </div>
                        <div class="mb-5">
                            <label for="district" class="form-label">District</label>
                            <input type="text" name="district" id="district" class="form-input bg-gray-200" value="{{ $graduate->district }}" />
                        </div>
                        <div class="mb-5">
                            <label for="city" class="form-label">City</label>
                            <input type="text" name="city" id="city" class="form-input bg-gray-200" value="{{ $graduate->city }}" />
                        </div>
                        <div class="mb-5">
                            <label for="scholarship_type" class="form-label">Type of Scholarship</label>
                            <input type="text" name="scholarship_type" id="scholarship_type" class="form-input bg-gray-200" value="{{ $graduate->scholarship_type }}" />
                        </div>
                        <div class="mb-5">
                            <label for="tvi" class="form-label">Name of TVI</label>
                            <input type="text" name="tvi" id="tvi" class="form-input bg-gray-200" value="{{ $graduate->tvi }}" />
                        </div>
                        <div class="mb-5">
                            <label for="allocation" class="form-label">Allocation</label>
                            <input type="text" name="allocation" id="allocation" class="form-input bg-gray-200" value="{{ $graduate->allocation }}" />
                        </div>
                    </fieldset>
                </div>
                <div class="tab-content hidden">
                    <div class="mb-5">
                        <label for="verification_means" class="form-label">Means of Verification</label>
                        <select name="verification_means" id="verification_means" class="form-input">
                            <option value="">-- Select a means of verification --</option>
                            @foreach ($verification_means as $means)
                                <option value="{{ $means }}" {{ old('verification_means', $graduate->verification_means) == $means ? 'selected' : '' }}>
                                    {{ $means }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-5">
                        <label for="verification_date" class="form-label">Date of Verification</label>
                        <input type="date" name="verification_date" id="verification_date" class="form-input" value="{{ old('verification_date', $graduate->verification_date) }}" />
                    </div>
                    <div class="mb-5">
                        <label class="form-label">Status of Verification</label>
                        <div class="mt-2 space-y-2">
                            <label for="respondedBtn" class="flex items-center">
                                <input type="radio" name="verification_status" id="respondedBtn" value="Responded" class="form-radio" {{ old('verification_status', $graduate->verification_status) == 'Responded' ? 'checked' : '' }} />
                                <span class="ml-2 text-gray-700">Responded</span>
                            </label>
                            <label for="noResponseBtn" class="flex items-center">
                                <input type="radio" name="verification_status" id="noResponseBtn" value="No Response (For Follow-Up)" class="form-radio" {{ old('verification_status', $graduate->verification_status) == 'No Response (For Follow-Up)' ? 'checked' : '' }} />
                                <span class="ml-2 text-gray-700">No Response (For Follow-Up)</span>
                            </label>
                        </div>
                        <hr class="mt-5">
                    </div>
                    <div class="verification-status-div mb-4" id="responded">
                        <div>
                            <label class="form-label">Type of Response</label>
                            <div class="mt-2 space-y-2">
                                <label for="interestedBtn" class="flex items-center">
                                    <input type="radio" name="response_status" id="interestedBtn" value="Interested" {{ old('response_status', $graduate->response_status) == "Interested" ? 'checked' : '' }} />
                                    <span class="ml-2 text-gray-700">Interested</span>
                                </label>
                                <label for="notInterestedBtn" class="flex items-center">
                                    <input type="radio" name="response_status" id="notInterestedBtn" value="Not Interested" {{ old('response_status', $graduate->response_status) == "Not Interested" ? 'checked' : '' }} />
                                    <span class="ml-2 text-gray-700">Not Interested</span>
                                </label>
                                {{-- response_status : Interested --}}
                                <div>
                                    <label class="form-label">Refer to Company?</label>
                                    <fieldset id="referralStatusForm" class="mt-2 space-y-2" disabled>
                                        {{-- referral_status : Yes --}}
                                        <label for="referYesBtn" class="flex items-center">
                                            <input type="radio" name="referral_status" id="referYesBtn" value="Yes" {{ old('referral_status', $graduate->referral_status) == "Yes" ? 'checked' : '' }} />
                                            <span class="ml-2 text-gray-700">YES</span>
                                        </label>
                                        <input type="date" name="referral_date" id="referralDate" class="form-input mb-3 ml-5" value="{{ old('referral_date', $graduate->referral_date) }}" disabled />
                                        {{-- referral_status : No --}}
                                        <label for="referNoBtn" class="flex items-center">
                                            <input type="radio" name="referral_status" id="referNoBtn" value="No" {{ old('referral_status', $graduate->referral_status) == "No" ? 'checked' : '' }} />
                                            <span class="ml-2 text-gray-700">NO</span>
                                        </label>
                                        <textarea name="no_referral_reason" id="noReferralReason" rows="3" class="form-input mb-3 ml-5" placeholder="Reason" disabled>
                                            {{ old('no_referral_reason', $graduate->no_referral_reason) }}
                                        </textarea>
                                    </fieldset>
                                </div>
                                {{-- response_status : Not Interested --}}
                                <div>
                                    <label for="notInterestedReason" class="form-label">Reason</label>
                                    <textarea name="not_interested_reason" id="notInterestedReason" rows="3" class="form-input" disabled>
                                        {{ old('not_interested_reason', $graduate->not_interested_reason) }}
                                    </textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="verification-status-div mb-4" id="noResponse">
                        <div></div>
                    </div>
                </div>
                <div class="tab-content hidden">
                    Employment
                </div>
            </form>
        </div>
    </div>
    {{-- Modal --}}
    <div class="relative z-10 hidden" id="confirmationModal" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-500/75 transition-opacity" aria-hidden="true"></div>
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:size-10">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-base font-semibold text-gray-900" id="modal-title">Delete Record</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">
                                        Are you sure you want to delete this record? All of its data will be permanently removed and this action cannot be undone.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <form action="{{ route('delete', $graduate->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" name="delete" class="btn-danger-modal" role="button" value="Delete" />
                            <button type="button" id="dismissCreate" class="btn-secondary-modal">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>