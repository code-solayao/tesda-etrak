@section('title', 'E-TRAK - Record details')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/e-trak/record-details.css') }}">
@endsection

@section('scripts')
    <script src="{{ asset('js/e-trak/record-details.js') }}"></script>
@endsection

<x-layout>
    <div class="text-center mb-4">
        <h1 class="display-4">Record Details</h1>
            <a href="{{ route('update-record-page', $graduate->id) }}" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325" />
                </svg> Update
            </a>
        <a href="{{ route('view-records') }}" class="btn btn-outline-secondary">View Records</a>
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteRecordModal">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
            </svg> Delete
        </button>
    </div>
    <div class="tab-buttons">
        <button class="tablink" id="detailsTab">Details</button>
        <button class="tablink" id="verificationTab">Verification</button>
        <button class="tablink" id="employmentTab" disabled>Employment</button>
    </div>
    <div class="tabcontent" id="details">
        <dl>
            <dt>Name: </dt>
            <dd>{{ $graduate->full_name }}</dd>
            <dt>Sex: </dt>
            <dd>{{ $graduate->sex }}</dd>
            <dt>Date of Birth: </dt>
            <dd class="dateFormat">{{ $graduate->birthdate }}</dd>
            <dt>Contact Number: </dt>
            <dd>{{ $graduate->contact_number }}</dd>
            <dt>E-mail Address: </dt>
            <dd>{{ $graduate->email }}</dd>
            <dt>Address: </dt>
            <dd>{{ $graduate->address }}</dd>
            <dt>Sector: </dt>
            <dd>{{ $graduate->sector }}</dd>
            <dt>Qualification Title: </dt>
            <dd>{{ $graduate->qualification_title }}</dd>
            <dt>District: </dt>
            <dd>{{ $graduate->district }}</dd>
            <dt>City: </dt>
            <dd>{{ $graduate->city }}</dd>
            <dt>Type of Scholarship: </dt>
            <dd>{{ $graduate->scholarship_type }}</dd>
            <dt>Name of TVI: </dt>
            <dd>{{ $graduate->tvi }}</dd>
            <dt>Year of Graduation: </dt>
            <dd>{{ $graduate->allocation }}</dd>
        </dl>
    </div>
    <div id="verification" class="tabcontent" style="font-size: 1.3em;">
        <dl>
            <dt>Means of Verification: </dt>
            <dd>{{ $graduate->verification_means }}</dd>
            <dt>Date of Verification: </dt>
            <dd class="dateFormat">{{ $graduate->verification_date }}</dd>
            <dt>Status of Verification: </dt>
            <dd id="verification_status">{{ $graduate->verification_status }}</dd>

            @switch($graduate->verification_status)
                @case("Responded")
                    <dt>Status of Response: </dt>
                    <dd>{{ $graduate->response_status }}</dd>

                    @switch($graduate->response_status)
                        @case("Interested")
                            <dt>Refer to Company? </dt>
                            <dd id="referralStatus">{{ $graduate->referral_status }}</dd>

                            @if ($graduate->referral_status === "Yes")
                                <dt>Date of Referral: </dt>
                                <dd class="dateFormat">{{ $graduate->referral_date }}</dd>
                            @elseif ($graduate->referral_status === "No")
                                <dt>Reason (No Referral): </dt>
                                <dd>{{ $graduate->no_referral_reason }}</dd>
                            @else
                                <dt>Date of Referral: </dt>
                                <dd class="dateFormat">{{ $graduate->referral_date }}</dd>
                                <dt>Reason (No Referral): </dt>
                                <dd>{{ $graduate->no_referral_reason }}</dd>
                            @endif
                            @break

                        @case("Not Interested")
                            <dt>Reason (Not Interested): </dt>
                            <dd>{{ $graduate->not_interested_reason }}</dd>
                            @break

                        @default
                            <dt>Refer to Company? </dt>
                            <dd id="referralStatus">{{ $graduate->referral_status }}</dd>

                            @if ($graduate->referral_status === "Yes")
                                <dt>Date of Referral: </dt>
                                <dd class="dateFormat">{{ $graduate->referral_date }}</dd>
                            @elseif ($graduate->referral_status === "No")
                                <dt>Reason (No Referral): </dt>
                                <dd>{{ $graduate->no_referral_reason }}</dd>
                            @else
                                <dt>Date of Referral: </dt>
                                <dd class="dateFormat">{{ $graduate->referral_date }}</dd>
                                <dt>Reason (No Referral): </dt>
                                <dd>{{ $graduate->no_referral_reason }}</dd>
                            @endif

                            <dt>Reason (Not Interested): </dt>
                            <dd>{{ $graduate->not_interested_reason }}</dd>
                    @endswitch
                    @break

                @case("No Response")
                    <dt>First Follow-up Date: </dt>
                    <dd class="dateFormat">{{ $graduate->follow_up_date_1 }}</dd>
                    <dt>Second Follow-up Date: </dt>
                    <dd class="dateFormat">{{ $graduate->follow_up_date_2 }}</dd>

                    @if (!empty($graduate->invalid_contact))
                        <dt>Invalid Contact? </dt>
                        <dd>{{ $graduate->invalid_contact }}</dd>
                    @endif
                    @break

                @default
                    <dt>Status of Response: </dt>
                    <dd>{{ $graduate->response_status }}</dd>

                    @switch($graduate->response_status)
                        @case("Interested")
                            <dt>Refer to Company? </dt>
                            <dd id="referralStatus">{{ $graduate->referral_status }}</dd>

                            @if ($graduate->referral_status === "Yes")
                                <dt>Date of Referral: </dt>
                                <dd class="dateFormat">{{ $graduate->referral_date }}</dd>
                            @elseif ($graduate->referral_status === "No")
                                <dt>Reason (No Referral): </dt>
                                <dd>{{ $graduate->no_referral_reason }}</dd>
                            @else
                                <dt>Date of Referral: </dt>
                                <dd class="dateFormat">{{ $graduate->referral_date }}</dd>
                                <dt>Reason (No Referral): </dt>
                                <dd>{{ $graduate->no_referral_reason }}</dd>
                            @endif
                            @break

                        @case("Not Interested")
                            <dt>Reason (Not Interested): </dt>
                            <dd>{{ $graduate->not_interested_reason }}</dd>
                            @break

                        @default
                            <dt>Refer to Company? </dt>
                            <dd id="referralStatus">{{ $graduate->referral_status }}</dd>

                            @if ($graduate->referral_status === "Yes")
                                <dt>Date of Referral: </dt>
                                <dd class="dateFormat">{{ $graduate->referral_date }}</dd>
                            @elseif ($graduate->referral_status === "No")
                                <dt>Reason (No Referral): </dt>
                                <dd>{{ $graduate->no_referral_reason }}</dd>
                            @else
                                <dt>Date of Referral: </dt>
                                <dd class="dateFormat">{{ $graduate->referral_date }}</dd>
                                <dt>Reason (No Referral): </dt>
                                <dd>{{ $graduate->no_referral_reason }}</dd>
                            @endif

                            <dt>Reason (Not Interested): </dt>
                            <dd>{{ $graduate->not_interested_reason }}</dd>
                    @endswitch

                    <dt>First Follow-up Date: </dt>
                    <dd class="dateFormat">{{ $graduate->follow_up_date_1 }}</dd>
                    <dt>Second Follow-up Date: </dt>
                    <dd class="dateFormat">{{ $graduate->follow_up_date_2 }}</dd>

                    @if (!empty($graduate->invalid_contact))
                        <dt>Invalid Contact? </dt>
                        <dd>{{ $graduate->invalid_contact }}</dd>
                    @endif
            @endswitch
        </dl>
    </div>
    <div class="tabcontent" style="font-size: 1.3em;" id="employment">
        <dl>
            <dt>Company Name: </dt>
            <dd>{{ $graduate->company_name }}</dd>
            <dt>Company Address: </dt>
            <dd>{{ $graduate->company_address }}</dd>
            <dt>Job Title: </dt>
            <dd>{{ $graduate->job_title }}</dd>

            <dt>Application Status: </dt>
            <dd>{{ $graduate->application_status }}</dd>
            @switch($graduate->application_status)
                @case("Continued")
                    <dt>Status of Employment: </dt>
                    <dd>{{ $graduate->employment_status }}</dd>
                    @switch($graduate->employment_status)
                        @case("Hired")
                            <dt>Date Hired: </dt>
                            <dd class="dateFormat">{{ $graduate->hired_date }}</dd>
                            @break
                        @case("Submitted Documents")
                            <dt>Submission of Documents Date: </dt>
                            <dd class="dateFormat">{{ $graduate->submitted_documents_date }}</dd>
                            @break
                        @case("For Interview")
                            <dt>Interview Date: </dt>
                            <dd class="dateFormat">{{ $graduate->interview_date }}</dd>
                            @break
                        @case("Not Hired")
                            <dt>Reason (Not Hired): </dt>
                            <dd>{{ $graduate->not_hired_reason }}</dd>
                            @break
                        @default
                            <dt class="indented-1">Date Hired: </dt>
                            <dd class="dateFormat indented-1">{{ $graduate->hired_date }}</dd>
                            <dt class="indented-1">Submission of Documents Date: </dt>
                            <dd class="dateFormat indented-1">{{ $graduate->submitted_documents_date }}</dd>
                            <dt class="indented-1">Interview Date: </dt>
                            <dd class="dateFormat indented-1">{{ $graduate->interview_date }}</dd>
                            <dt class="indented-1">Reason (Not Hired): </dt>
                            <dd class="indented-1">{{ $graduate->not_hired_reason }}</dd>
                    @endswitch
                    @break

                @case("Withdrawn")
                    <dt>Reason (Withdrawn): </dt>
                    <dd>{{ $graduate->withdrawn_reason }}</dd>
                    @break

                @default
                    <dt>Status of Employment: </dt>
                    <dd>{{ $graduate->employment_status }}</dd>
                    @switch($graduate->employment_status)
                        @case("Hired")
                            <dt>Date Hired: </dt>
                            <dd class="dateFormat">{{ $graduate->hired_date }}</dd>
                            @break
                        @case("Submitted Documents")
                            <dt>Submission of Documents Date: </dt>
                            <dd class="dateFormat">{{ $graduate->submitted_documents_date }}</dd>
                            @break
                        @case("For Interview")
                            <dt>Interview Date: </dt>
                            <dd class="dateFormat">{{ $graduate->interview_date }}</dd>
                            @break
                        @case("Not Hired")
                            <dt>Reason (Not Hired): </dt>
                            <dd>{{ $graduate->not_hired_reason }}</dd>
                            @break
                        @default
                            <dt class="indented-1">Date Hired: </dt>
                            <dd class="dateFormat indented-1">{{ $graduate->hired_date }}</dd>
                            <dt class="indented-1">Submission of Documents Date: </dt>
                            <dd class="dateFormat indented-1">{{ $graduate->submitted_documents_date }}</dd>
                            <dt class="indented-1">Interview Date: </dt>
                            <dd class="dateFormat indented-1">{{ $graduate->interview_date }}</dd>
                            <dt class="indented-1">Reason (Not Hired): </dt>
                            <dd class="indented-1">{{ $graduate->not_hired_reason }}</dd>
                    @endswitch
                    <dt>Reason (Withdrawn): </dt>
                    <dd>{{ $graduate->withdrawn_reason }}</dd>
            @endswitch
        </dl>
    </div>
    <!-- Modal -->
    <div class="modal" id="deleteRecordModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Submit Record</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Do you truly confirm deleting this record? Please note this action cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('delete-record', $graduate->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" role="button" name="submit" value="Confirm" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>