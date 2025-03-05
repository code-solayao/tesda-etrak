@section('title', 'E-TRAK - Update record')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/e-trak/update-record.css') }}">
@endsection

@section('scripts')
    <script src="{{ asset('js/e-trak/record-details.js') }}"></script>
@endsection

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
    <form action="{{ route('update-record') }}" method="POST">
        @csrf
        <div class="tabcontent" id="details">
            <fieldset disabled>
                <!-- FULL NAME -->
                <div class="form-group mb-4">
                    <label class="form-label control-label-2">Last Name</label>
                    <input type="text" class="form-control" name="last_name" value="{{ $graduate->last_name }}">
                </div>
                <div class="form-group mb-4">
                    <label class="form-label control-label-2">First Name</label>
                    <input type="text" class="form-control" name="first_name" value="{{ $graduate->first_name }}" />
                </div>
                <div class="form-group mb-4">
                    <label class="form-label control-label-2">Middle Name</label>
                    <input type="text" class="form-control" name="middle_name" value="{{ $graduate->middle_name }}" />
                </div>
                <div class="form-group mb-5">
                    <label class="form-label control-label-2">Extension Name</label>
                    <input type="text" class="form-control" name="extension_name" value="{{ $graduate->extension_name }}" />
                </div>
                <div class="form-group mb-5">
                    <label class="form-label control-label-2">Full Name</label>
                    <input type="text" class="form-control" name="full_name" value="{{ $graduate->full_name }}" />
                </div>
                <!-- INITIAL DATA -->
                <div class="form-group mb-3">
                    <label class="form-label control-label-2">Sex</label>
                    <input type="text" class="form-control" name="sex" value="{{ $graduate->sex }}" />
                </div>
                <div class="form-group mb-4">
                    <label class="form-label control-label-2">Date of Birth</label>
                    <input type="text" class="form-control" name="birthdate" value="{{ $graduate->birthdate }}" />
                </div>
                <div class="form-group mb-4">
                    <label class="form-label control-label-2">Contact Number</label>
                    <input type="text" class="form-control" name="contact_number" value="{{ $graduate->contact_number }}" />
                </div>
                <div class="form-group mb-4">
                    <label class="form-label control-label-2">Address</label>
                    <input type="text" class="form-control" row="5" name="address" value="{{ $graduate->address }}" />
                </div>
                <div class="form-group mb-4">
                    <label class="form-label control-label-2">E-mail Address</label>
                    <input type="text" class="form-control" name="email" value="{{ $graduate->email }}" />
                </div>
                <div class="form-group mb-4">
                    <label class="form-label control-label-2">Sector</label>
                    <input type="text" class="form-control" name="sector" value="{{ $graduate->sector }}" />
                </div>
                <div class="form-group mb-4">
                    <label class="form-label control-label-2">Qualification Title</label>
                    <input type="text" class="form-control" name="qualification_title" value="{{ $graduate->qualification_title }}" />
                </div>
                <div class="form-group mb-4">
                    <label class="form-label control-label-2">District</label>
                    <input type="text" class="form-control" name="district" value="{{ $graduate->district }}" />
                </div>
                <div class="form-group mb-4">
                    <label class="form-label control-label-2">City</label>
                    <input type="text" class="form-control" name="city" value="{{ $graduate->city }}" />
                </div>
                <div class="form-group mb-4">
                    <label class="form-label control-label-2">Type of Scholarship</label>
                    <input type="text" class="form-control" name="scholarship_type" value="{{ $graduate->scholarship_type }}" />
                </div>
                <div class="form-group mb-4">
                    <label class="form-label control-label-2">Name of TVI</label>
                    <input type="text" class="form-control" name="tvi" value="{{ $graduate->tvi }}" />
                </div>
                <div class="form-group mb-3">
                    <label class="form-label control-label-2">Allocation</label>
                    <input type="text" class="form-control" name="allocation" value="{{ $graduate->allocation }}" />
                </div>
            </fieldset>
        </div>
        <div class="tabcontent" id="verification">
            <div class="container">
                <div class="form-group mb-4">
                    <label class="form-label control-label-1" for="verification_means">Means of Verification</label>
                    <select class="form-control" id="verification_means" name="verification_means">
                        <?php
                            $verifmeans_options = ["None", "For Verification", "Phone-called", "E-mailed", "SMS"];
                            $verifmeans_db = (!empty($verification_means)) ? $verification_means : "None";
                            foreach ($verifmeans_options as $option) { ?>
                            <option value="<?php echo $option; ?>" <?php echo ($option == $verifmeans_db) ? 'selected' : ''; ?>>
                                <?php echo ucfirst($option); ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group mb-4">
                    <label class="form-label control-label-1" for="verification_date">Date of Verification</label>
                    <input class="form-control" type="date" id="verification_date" name="verification_date" value="<?php echo $verification_date ?>" />
                </div>
                <div class="form-group">
                    <label class="form-label control-label-1" for="respondedBtn">Status of Verification</label>

                    <div class="form-check">
                        <?php
                            $responded = "Responded";
                            $no_response = "No Response"; 
                        ?>
                        <input class="form-check-input" type="radio" id="respondedBtn" name="verification_status" value="Responded" <?php echo ($verification_status == $responded) ? 'checked' : ''; ?> />
                        <label class="form-label" for="respondedBtn">Responded</label>
                        <br />
                        <input class="form-check-input" type="radio" id="noResponseBtn" name="verification_status" value="No Response" <?php echo ($verification_status == $no_response) ? 'checked' : ''; ?> />
                        <label class="form-label" for="noResponseBtn">No Response</label>
                    </div>
                </div>
                <div class="verification-status-div mb-4" id="responded">
                    <div class="form-group">
                        <label class="form-label control-label-1">Type of Response</label>

                        <div style="margin-left: 30px" class="form-check">
                            <?php
                                $interested = "Interested";
                                $not_interested = "Not Interested";
                            ?>
                            <input class="form-check-input" type="radio" id="interestedBtn" name="response_status" value="Interested" <?php echo ($response_status == $interested) ? 'checked' : ''; ?> />
                            <label class="form-label" for="interestedBtn">Interested</label>
                            <div>
                                <label class="form-label control-label-2">Refer to Company?</label>

                                <div style="margin-left: 30px">
                                    <fieldset id="referralStatusForm" disabled>
                                        <?php
                                            $yes = "Yes";
                                            $no = "No";
                                        ?>
                                        <input class="form-check-input" type="radio" id="referYesBtn" name="referral_status" value="Yes" <?php echo ($referral_status == $yes) ? 'checked' : ''; ?> />
                                        <label class="form-label" for="referYesBtn">YES</label>
                                        <br />
                                        <input class="form-control" type="date" id="referralDate" name="referral_date" value="<?php echo $referral_date ?>" disabled />
                                        <br />
                                        <input class="form-check-input" type="radio" id="referNoBtn" name="referral_status" value="No" <?php echo ($referral_status == $no) ? 'checked' : ''; ?> />
                                        <label class="form-label" for="referNoBtn">NO</label>
                                        <br />
                                        <label class="form-label" for="noReferralReason">Reason</label>
                                        <input class="form-control" type="text" id="noReferralReason" name="no_referral_reason" value="<?php echo $no_referral_reason ?>" disabled />
                                    </fieldset>
                                </div>
                            </div><br />

                            <input class="form-check-input" type="radio" id="notInterestedBtn" name="response_status" value="Not Interested" <?php echo ($response_status == $not_interested) ? 'checked' : ''; ?> />
                            <label class="form-label" for="notInterestedBtn">Not Interested</label>
                            <div>
                                <label class="form-label" for="notInterestedBtn">Reason</label>
                                <input class="form-control" type="text" row="5" id="notInterestedReason" name="not_interested_reason" value="<?php echo $not_interested_reason ?>" disabled />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="verification-status-div mb-4" id="noResponse">
                    <div class="form-group">
                        <label class="form-label control-label-2">No Response (For Follow-up)</label>

                        <div style="margin-left: 30px" class="mb-4">
                            <label class="form-label" for="followup1">First Follow-up</label>
                            <input class="form-control" type="date" id="followup1" name="follow_up_date_1" value="<?php echo $follow_up_date_1 ?>" />
                        </div>
                        <div style="margin-left: 30px" class="mb-4">
                            <label class="form-label" for="followup2">Second Follow-up</label>
                            <input class="form-control" type="date" id="followup2" name="follow_up_date_2" value="<?php echo $follow_up_date_2 ?>" />
                        </div>
                        <div style="margin-left: 30px" class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" id="invalidContact" name="invalid_contact" value="Yes" <?php echo ($invalid_contact == "Yes") ? 'checked' : '' ?> />
                            <label class="form-check-label" for="invalidContact">Invalid Contact</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" role="button" name="submit" value="Submit" />
                    <a class="btn btn-secondary" role="button" href="../records/details.php?id=<?php echo $id ?>">Cancel</a>
                </div>
            </div>
        </div>
        <div class="tabcontent" id="employment">
            <div class="container">
                <?php 
                    if (!empty($validation_message)) { 
                        echo "
                        <div class='alert alert-danger' role='alert'>
                            $validation_message
                        </div>
                        ";
                    }
                ?>
                <fieldset id="employmentField" disabled>
                    <div class="form-group mb-4">
                        <label class="form-label control-label-1" for="companyName">Name of Company</label>
                        <input class="form-control" type="text" id="companyName" name="company_name" value="<?php echo $company_name ?>" />
                    </div>
                    <div class="form-group mb-4">
                        <label class="form-label control-label-1" for="companyAddress">Address</label>
                        <input class="form-control" type="text" row="5" id="companyAddress" name="company_address" value="<?php echo $company_address ?>" />
                    </div>
                    <div class="form-group mb-4">
                        <label class="form-label control-label-1" for="jobTitle">Job Title</label>
                        <input class="form-control" type="text" id="jobTitle" name="job_title" value="<?php echo $job_title ?>" />
                    </div>
                    <div class="form-group mb-4">
                        <label class="form-label control-label-1">Employment Status</label>

                        <div class="form-check">
                            <?php
                                $hired = "Hired";
                                $submit_docs = "Submitted Documents";
                                $for_interview = "For Interview";
                                $not_hired = "Not Hired";
                            ?>
                            <input class="form-check-input" type="radio" id="hired" name="employment_status" value="Hired" <?php echo ($employment_status == $hired) ? 'checked' : '' ?> />
                            <label class="form-label employment-status-label" for="hired">Hired</label>
                            <div class="indent mb-4">
                                <input class="form-control" type="date" id="hiredDate" name="hired_date" value="<?php echo $hired_date ?>" disabled />
                            </div>
                            <input class="form-check-input" type="radio" id="submitDocs" name="employment_status" value="Submitted Documents" <?php echo ($employment_status == $submit_docs) ? 'checked' : '' ?> />
                            <label class="form-label employment-status-label" for="submitDocs">Submitted Documents</label>
                            <div class="indent-1 mb-4">
                                <input class="form-control" type="date" id="submitDocsDate" name="submitted_documents_date" value="<?php echo $submitted_documents_date ?>" disabled />
                            </div>
                            <input class="form-check-input" type="radio" id="forInterview" name="employment_status" value="For Interview" <?php echo ($employment_status == $for_interview) ? 'checked' : '' ?> />
                            <label class="form-label employment-status-label" for="forInterview">For Interview</label>
                            <div class="indent-1 mb-4">
                                <input class="form-control" type="date" id="interviewDate" name="interview_date" value="<?php echo $interview_date ?>" disabled />
                            </div>
                            <input class="form-check-input" type="radio" id="notHired" name="employment_status" value="Not Hired" <?php echo ($employment_status == $hired) ? 'checked' : '' ?> />
                            <label class="form-label employment-status-label" for="notHired">Not Hired</label>
                            <div class="indent-1 mb-4">
                                <label class="form-label" for="notHiredReason">Reason</label>
                                <select class="form-control" id="notHiredReason" name="not_hired_reason" disabled>
                                    <?php
                                        $not_hired_reasons = ["None", "Underage", "Upskilling", "Lack of Experience", "Did not meet the requirements"];
                                        $reason_db = (!empty($not_hired_reason)) ? $not_hired_reason : "None";
                                        foreach ($not_hired_reasons as $reason) { ?>
                                        <option value="<?php echo $reason ?>" <?php echo ($reason == $reason_db) ? 'selected' : ''; ?>>
                                            <?php echo ucfirst($reason); ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div>
                        <input class="btn btn-primary" type="submit" role="button" name="submit" value="Submit" />
                        <a class="btn btn-secondary" role="button" href="../records/details.php?id=<?php echo $id ?>">Cancel</a>
                    </div>
                </fieldset>
            </div>
        </div>
    </form>
</x-layout>