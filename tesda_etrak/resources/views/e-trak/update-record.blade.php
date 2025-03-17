@section('title', 'E-TRAK - Update record')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/e-trak/update-record.css') }}">
@endsection

@section('scripts')
    <script src="{{ asset('js/e-trak/update-record.js') }}"></script>
@endsection

@php
    $verification_means = [
        "For Verification", "Phone-called", "E-mailed", "SMS"
    ];
    $not_hired_reasons = [
        "Underage", "Upskilling", "Lack of Experience", "Did not meet the requirements"
    ];
@endphp

<x-layout>
    <div class="text-center mb-4">
        <h1 class="display-4">Update Record</h1>
        <a href="{{ route('record-details', $graduate->id) }}" class="btn btn-secondary" role="button">Cancel</a>
    </div>
    <div class="tab-buttons"> 
        <button class="tablink" id="detailsTab">Details</button>
        <button class="tablink" id="verificationTab">Verification</button>
        <button class="tablink" id="employmentTab">Employment</button>
    </div>
    <form action="{{ route('update-record', $graduate->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="tabcontent" id="details">
            <fieldset hidden>
                <div class="form-group mb-4">
                    <label for="verification_means" class="form-label control-label-2">Means of Verification</label>
                    <input type="text" class="form-control" id="verification_means" name="verification_means" value="{{ $graduate->verification_means }}" />
                </div>
                <div class="form-group mb-4">
                    <label for="verification_date" class="form-label control-label-2">Date of Verification</label>
                    <input type="text" class="form-control" id="verification_date" name="verification_date" value="{{ $graduate->verification_date }}" />
                </div>
                <div class="form-group mb-4">
                    <label for="verification_status" class="form-label control-label-2">Status of Verification</label>
                    <input type="text" class="form-control" id="verification_status" name="verification_status" value="{{ $graduate->verification_status }}" />
                </div>
                <div class="form-group mb-4">
                    <label for="follow_up_date_1" class="form-label control-label-2">First Follow-up Date</label>
                    <input type="text" class="form-control" id="follow_up_date_1" name="follow_up_date_1" value="{{ $graduate->follow_up_date_1 }}" />
                </div>
                <div class="form-group mb-4">
                    <label for="follow_up_date_2" class="form-label control-label-2">Second Follow-up Date</label>
                    <input type="text" class="form-control" id="follow_up_date_2" name="follow_up_date_2" value="{{ $graduate->follow_up_date_2 }}" />
                </div>
                <div class="form-group mb-4">
                    <label for="response_status" class="form-label control-label-2">Type of Response</label>
                    <input type="text" class="form-control" id="response_status" name="response_status" value="{{ $graduate->response_status }}" />
                </div>
                <div class="form-group mb-4">
                    <label for="not_interested_reason" class="form-label control-label-2">Reason (Not Interested)</label>
                    <input type="text" class="form-control" id="not_interested_reason" name="not_interested_reason" value="{{ $graduate->not_interested_reason }}" />
                </div>
                <div class="form-group mb-4">
                    <label for="referral_status" class="form-label control-label-2">Refer to Company?</label>
                    <input type="text" class="form-control" id="referral_status" name="referral_status" value="{{ $graduate->referral_status }}" />
                </div>
                <div class="form-group mb-4">
                    <label for="referral_date" class="form-label control-label-2">Date of Referral</label>
                    <input type="text" class="form-control" id="referral_date" name="referral_date" value="{{ $graduate->referral_date }}" />
                </div>
                <div class="form-group mb-4">
                    <label for="no_referral_reason" class="form-label control-label-2">Reason (No Referral)</label>
                    <input type="text" class="form-control" id="no_referral_reason" name="no_referral_reason" value="{{ $graduate->no_referral_reason }}" />
                </div>
                <div class="form-group mb-4">
                    <label for="invalid_contact" class="form-label control-label-2">Invalid Contact</label>
                    <input type="text" class="form-control" id="invalid_contact" name="invalid_contact" value="{{ $graduate->invalid_contact }}" />
                </div>
                <div class="form-group mb-4">
                    <label for="company_name" class="form-label control-label-2">Name of Company</label>
                    <input type="text" class="form-control" id="company_name" name="company_name" value="{{ $graduate->company_name }}" />
                </div>
                <div class="form-group mb-4">
                    <label for="company_address" class="form-label control-label-2">Address of Company</label>
                    <input type="text" class="form-control" id="company_address" name="company_address" value="{{ $graduate->company_address }}" />
                </div>
                <div class="form-group mb-4">
                    <label for="job_title" class="form-label control-label-2">Job Title</label>
                    <input type="text" class="form-control" id="job_title" name="job_title" value="{{ $graduate->job_title }}" />
                </div>
                <div class="form-group mb-4">
                    <label for="employment_status" class="form-label control-label-2">Status of Employment</label>
                    <input type="text" class="form-control" id="employment_status" name="employment_status" value="{{ $graduate->employment_status }}" />
                </div>
                <div class="form-group mb-4">
                    <label for="hired_date" class="form-label control-label-2">Hired</label>
                    <input type="text" class="form-control" id="hired_date" name="hired_date" value="{{ $graduate->hired_date }}" />
                </div>
                <div class="form-group mb-4">
                    <label for="submitted_documents_date" class="form-label control-label-2">Submitted Documents</label>
                    <input type="text" class="form-control" id="submitted_documents_date" name="submitted_documents_date" value="{{ $graduate->submitted_documents_date }}" />
                </div>
                <div class="form-group mb-4">
                    <label for="interview_date" class="form-label control-label-2">For Interview</label>
                    <input type="text" class="form-control" id="interview_date" name="interview_date" value="{{ $graduate->interview_date }}" />
                </div>
                <div class="form-group mb-4">
                    <label for="not_hired_reason" class="form-label control-label-2">Reason (Not Hired)</label>
                    <input type="text" class="form-control" id="not_hired_reason" name="not_hired_reason" value="{{ $graduate->not_hired_reason }}" />
                </div>
            </fieldset>
            <fieldset disabled>
                <!-- FULL NAME -->
                <div class="form-group mb-4">
                    <label for="last_name" class="form-label control-label-2">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $graduate->last_name }}" />
                </div>
                <div class="form-group mb-4">
                    <label for="first_name" class="form-label control-label-2">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $graduate->first_name }}" />
                </div>
                <div class="form-group mb-4">
                    <label for="middle_name" class="form-label control-label-2">Middle Name</label>
                    <input type="text" class="form-control" id="middle_name" name="middle_name" value="{{ $graduate->middle_name }}" />
                </div>
                <div class="form-group mb-4">
                    <label for="extension_name" class="form-label control-label-2">Extension Name</label>
                    <input type="text" class="form-control" id="extension_name" name="extension_name" value="{{ $graduate->extension_name }}" />
                </div>
                <div class="form-group mb-5">
                    <label for="full_name" class="form-label control-label-2">Full Name</label>
                    <input type="text" class="form-control" id="full_name" name="full_name" value="{{ $graduate->full_name }}" />
                </div>
                <!-- INITIAL DATA -->
                <div class="form-group mb-3">
                    <label for="sex" class="form-label control-label-2">Sex</label>
                    <input type="text" class="form-control" id="sex" name="sex" value="{{ $graduate->sex }}" />
                </div>
                <div class="form-group mb-4">
                    <label for="birthdate" class="form-label control-label-2">Date of Birth</label>
                    <input type="text" class="form-control" id="birthdate" name="birthdate" value="{{ $graduate->birthdate }}" />
                </div>
                <div class="form-group mb-4">
                    <label for="contact_number" class="form-label control-label-2">Contact Number</label>
                    <input type="text" class="form-control" id="contact_number" name="contact_number" value="{{ $graduate->contact_number }}" />
                </div>
                <div class="form-group mb-4">
                    <label for="address" class="form-label control-label-2">Address</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ $graduate->address }}" row="5" />
                </div>
                <div class="form-group mb-4">
                    <label for="email" class="form-label control-label-2">E-mail Address</label>
                    <input type="text" class="form-control" id="email" name="email" value="{{ $graduate->email }}" />
                </div>
                <div class="form-group mb-4">
                    <label for="sector" class="form-label control-label-2">Sector</label>
                    <input type="text" class="form-control" id="sector" name="sector" value="{{ $graduate->sector }}" />
                </div>
                <div class="form-group mb-4">
                    <label for="qualification_title" class="form-label control-label-2">Qualification Title</label>
                    <input type="text" class="form-control" id="qualification_title" name="qualification_title" value="{{ $graduate->qualification_title }}" />
                </div>
                <div class="form-group mb-4">
                    <label for="district" class="form-label control-label-2">District</label>
                    <input type="text" class="form-control" id="district" name="district" value="{{ $graduate->district }}" />
                </div>
                <div class="form-group mb-4">
                    <label for="city" class="form-label control-label-2">City</label>
                    <input type="text" class="form-control" id="city" name="city" value="{{ $graduate->city }}" />
                </div>
                <div class="form-group mb-4">
                    <label for="scholarship_type" class="form-label control-label-2">Type of Scholarship</label>
                    <input type="text" class="form-control" id="scholarship_type" name="scholarship_type" value="{{ $graduate->scholarship_type }}" />
                </div>
                <div class="form-group mb-4">
                    <label for="tvi" class="form-label control-label-2">Name of TVI</label>
                    <input type="text" class="form-control" id="tvi" name="tvi" value="{{ $graduate->tvi }}" />
                </div>
                <div class="form-group mb-3">
                    <label for="allocation" class="form-label control-label-2">Allocation</label>
                    <input type="text" class="form-control" id="allocation" name="allocation" value="{{ $graduate->allocation }}" />
                </div>
            </fieldset>
        </div>
        <div class="tabcontent" id="verification">
            <div class="container">
                <div class="form-group mb-4">
                    <label for="verification_means" class="form-label control-label-1">Means of Verification</label>
                    <select name="verification_means" id="verification_means" class="form-control">
                        <option value="">-- Select a means of verification --</option>
                        @foreach ($verification_means as $means)
                            <option value="{{ $means }}" {{ old('verification_means', $graduate->verification_means) == $means ? 'selected' : '' }}>
                                {{ $means }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-4">
                    <label for="verification_date" class="form-label control-label-1">Date of Verification</label>
                    <input type="date" class="form-control" id="verification_date" name="verification_date" value="{{ old('verification_date', $graduate->verification_date) }}" />
                </div>
                <div class="form-group">
                    <label for="respondedBtn" class="form-label control-label-1">Status of Verification</label>

                    <div class="form-check">
                        <input type="radio" class="form-check-input" id="respondedBtn" name="verification_status" value="Responded" {{ old('verification_status', $graduate->verification_status) == "Responded" ? 'checked' : '' }} />
                        <label class="form-label" for="respondedBtn">Responded</label>
                        <br>
                        <input type="radio" class="form-check-input" id="noResponseBtn" name="verification_status" value="No Response (For Follow-Up)" {{ old('verification_status', $graduate->verification_status) == "No Response (For Follow-Up)" ? 'checked' : '' }} />
                        <label class="form-label" for="noResponseBtn">No Response</label>
                    </div>
                </div>
                <div class="verification-status-div mb-4" id="responded">
                    <div class="form-group">
                        <label class="form-label control-label-1">Type of Response</label>

                        <div style="margin-left: 30px" class="form-check">
                            <input type="radio" class="form-check-input" id="interestedBtn" name="response_status" value="Interested" {{ old('response_status', $graduate->response_status) == "Interested" ? 'checked' : '' }} />
                            <label for="interestedBtn" class="form-label">Interested</label>
                            <div>
                                <label class="form-label control-label-2">Refer to Company?</label>

                                <div style="margin-left: 30px">
                                    <fieldset id="referralStatusForm" disabled>
                                        <input type="radio" class="form-check-input" id="referYesBtn" name="referral_status" value="Yes" {{ old('referral_status', $graduate->referral_status) == "Yes" ? 'checked' : '' }} />
                                        <label for="referYesBtn" class="form-label">YES</label>
                                        <br>
                                        <input type="date" class="form-control" id="referralDate" name="referral_date" value="{{ old('referral_date', $graduate->referral_date) }}" disabled />
                                        <br>
                                        <input type="radio" class="form-check-input" id="referNoBtn" name="referral_status" value="No" {{ old('referral_status', $graduate->referral_status) == "No" ? 'checked' : '' }} />
                                        <label for="referNoBtn" class="form-label">NO</label>
                                        <br>
                                        <label for="noReferralReason" class="form-label">Reason</label>
                                        <input type="text" class="form-control" id="noReferralReason" name="no_referral_reason" value="{{ old('no_referral_reason', $graduate->no_referral_reason) }}" disabled />
                                    </fieldset>
                                </div>
                            </div><br>

                            <input type="radio" class="form-check-input" id="notInterestedBtn" name="response_status" value="Not Interested" {{ old('response_status', $graduate->response_status) == "Not Interested" ? 'checked' : '' }} />
                            <label for="notInterestedBtn" class="form-label">Not Interested</label>
                            <div>
                                <label for="notInterestedReason" class="form-label">Reason</label>
                                <textarea name="not_interested_reason" id="notInterestedReason" class="form-control" rows="2" disabled>{{ old('not_interested_reason', $graduate->not_interested_reason) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="verification-status-div mb-4" id="noResponse">
                    <div class="form-group">
                        <label class="form-label control-label-2">No Response (For Follow-up)</label>

                        <div style="margin-left: 30px" class="mb-4">
                            <label for="followup1" class="form-label">First Follow-up</label>
                            <input type="date" class="form-control" id="followup1" name="follow_up_date_1" value="{{ old('follow_up_date_1', $graduate->follow_up_date_1) }}" />
                        </div>
                        <div style="margin-left: 30px" class="mb-4">
                            <label for="followup2" class="form-label">Second Follow-up</label>
                            <input type="date" class="form-control" id="followup2" name="follow_up_date_2" value="{{ old('follow_up_date_2', $graduate->follow_up_date_2) }}" />
                        </div>
                        <div style="margin-left: 30px" class="form-check mb-4">
                            <input type="checkbox" class="form-check-input" id="invalidContact" name="invalid_contact" value="Yes" {{ old('invalid_contact', $graduate->invalid_contact) == 'Yes' ? 'checked' : '' }} />
                            <label for="invalidContact" class="form-check-label">Invalid Contact</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" role="button" name="submit" value="Submit" />
                    <a href="{{ route('record-details', $graduate->id) }}" class="btn btn-secondary" role="button">Cancel</a>
                </div>
            </div>
        </div>
        <div class="tabcontent" id="employment">
            <div class="container">
                <fieldset id="employmentField" disabled>
                    <div class="form-group mb-4">
                        <label for="companyName" class="form-label control-label-1">Name of Company</label>
                        <input type="text" class="form-control" id="companyName" name="company_name" value="{{ old('company_name', $graduate->company_name) }}" />
                    </div>
                    <div class="form-group mb-4">
                        <label for="companyAddress" class="form-label control-label-1">Address</label>
                        <input type="text" class="form-control" id="companyAddress" row="5" name="company_address" value="{{ old('company_address', $graduate->company_address) }}" />
                    </div>
                    <div class="form-group mb-4">
                        <label for="jobTitle" class="form-label control-label-1">Job Title</label>
                        <input type="text" class="form-control" id="jobTitle" name="job_title" value="{{ old('job_title', $graduate->job_title) }}" />
                    </div>
                    <div class="form-group">
                        <label for="continuedBtn" class="form-label control-label-1">Application Status</label>
    
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="continuedBtn" name="application_status" value="Continued" {{ old('application_status', $graduate->application_status) == "Continued" ? 'checked' : '' }} />
                            <label for="continuedBtn" class="form-label">Continued</label>
                            <br>
                            <input type="radio" class="form-check-input" id="withdrawnBtn" name="application_status" value="Withdrawn" {{ old('application_status', $graduate->application_status) == "Withdrawn" ? 'checked' : '' }} />
                            <label for="withdrawnBtn" class="form-label">Withdrawn</label>
                        </div>
                    </div>
                    <div class="form-group mb-4 application-status-div" id="continued">
                        <label class="form-label control-label-1">Employment Status</label>

                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="hired" name="employment_status" value="Hired" {{ old('employment_status', $graduate->employment_status) == 'Hired' ? 'checked' : '' }} />
                            <label for="hired" class="form-label employment-status-label">Hired</label>
                            <div class="indent mb-4">
                                <input type="date" class="form-control" id="hiredDate" name="hired_date" value="{{ old('hired_date', $graduate->hired_date) }}" disabled />
                            </div>
                            <input type="radio" class="form-check-input" id="submitDocs" name="employment_status" value="Submitted Documents" {{ old('employment_status', $graduate->employment_status) == 'Submitted Documents' ? 'checked' : '' }} />
                            <label for="submitDocs" class="form-label employment-status-label">Submitted Documents</label>
                            <div class="indent-1 mb-4">
                                <input type="date" class="form-control" id="submitDocsDate" name="submitted_documents_date" value="{{ old('submitted_documents_date', $graduate->submitted_documents_date) }}" disabled />
                            </div>
                            <input type="radio" class="form-check-input" id="forInterview" name="employment_status" value="For Interview" {{ old('employment_status', $graduate->employment_status) == 'For Interview' ? 'checked' : '' }} />
                            <label for="forInterview" class="form-label employment-status-label">For Interview</label>
                            <div class="indent-1 mb-4">
                                <input type="date" class="form-control" id="interviewDate" name="interview_date" value="{{ old('interview_date', $graduate->interview_date) }}" disabled />
                            </div>
                            <input type="radio" class="form-check-input" id="notHired" name="employment_status" value="Not Hired" {{ old('employment_status', $graduate->employment_status) == 'Not Hired' ? 'checked' : '' }} />
                            <label for="notHired" class="form-label employment-status-label">Not Hired</label>
                            <div class="indent-1 mb-4">
                                <label for="notHiredReason" class="form-label">Reason</label>
                                <select name="not_hired_reason" id="notHiredReason" class="form-control" disabled>
                                    <option value="">-- Select a reason --</option>
                                    @foreach ($not_hired_reasons as $reason)
                                        <option value="{{ $reason }}" {{ old('not_hired_reason', $graduate->not_hired_reason) == $reason ? 'selected' : '' }}>
                                            {{ $reason }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-4 application-status-div" id="withdrawn">
                        <div class="form-group mb-4">
                            <label for="withdrawn_reason" class="form-label control-label-1">Reason</label>
                            <textarea name="withdrawn_reason" id="withdrawn_reason" class="form-control" rows="3">{{ old('withdrawn_reason', $graduate->withdrawn_reason) }}</textarea>
                        </div>
                    </div>
                    <div>
                        <input type="submit" class="btn btn-primary" role="button" name="submit" value="Submit" />
                        <a href="{{ route('record-details', $graduate->id) }}" class="btn btn-secondary" role="button">Cancel</a>
                    </div>
                </fieldset>
            </div>
        </div>
    </form>
</x-layout>