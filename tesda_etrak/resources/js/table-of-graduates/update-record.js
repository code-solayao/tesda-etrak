//#region VARIABLES
var verificationTab = document.getElementById("verificationTab");

var noVerifStatusBtn = document.getElementById("noVerifStatusBtn");
var respondedBtn = document.getElementById("respondedBtn");
var noResponseBtn = document.getElementById("noResponseBtn");

var interestedBtn = document.getElementById("interestedBtn");
var notInterestedBtn = document.getElementById("notInterestedBtn");
var interested = document.getElementById("interested");
var notInterested = document.getElementById("notInterested");

var referralStatusForm = document.getElementById("referralStatusForm");
var referYesBtn = document.getElementById("referYesBtn");
var referNoBtn = document.getElementById("referNoBtn");
var referralDate = document.getElementById("referralDate");
var noReferralReason = document.getElementById("noReferralReason");

var notInterestedReason = document.getElementById("notInterestedReason");

var invalidContact = document.getElementById("invalidContact");
var followUpRemarks = document.getElementById("followUpRemarks");

var proceedBtn = document.getElementById("proceedBtn");
var notProceedBtn = document.getElementById("notProceedBtn");
var proceed = document.getElementById("proceed");
var notProceed = document.getElementById("notProceed");
var notProceedReason = document.getElementById("notProceedReason");
//#endregion

//#region INITIALISATION
document.getElementById("detailsTab")?.addEventListener('click', function () {
    openTab(0, "details");
});
verificationTab?.addEventListener('click', function () {
    openTab(1, "verification");

    interested.style.display = "none";
    notInterested.style.display = "none";
    refreshVerification();
});
document.getElementById("employmentTab")?.addEventListener('click', function () {
    openTab(2, "employment");
});

noVerifStatusBtn?.addEventListener('click', function () {
    verificationStatusValue("");
});
respondedBtn?.addEventListener('click', function () {
    verificationStatusValue("responded");
});
noResponseBtn?.addEventListener('click', function () {
    verificationStatusValue("no response");
});

interestedBtn?.addEventListener('click', function () {
    interested.style.display = "block";
    notInterested.style.display = "none";

    referralStatusForm.disabled = false;
    notInterestedReason.disabled = true;
    notInterestedReason.value = "";
});
notInterestedBtn?.addEventListener('click', function () {
    notInterested.style.display = "block";
    interested.style.display = "none";

    notInterestedReason.disabled = false;
    referralStatusForm.disabled = true;
    referYesBtn.checked = false;
    referNoBtn.checked = false;
    referralDate.disabled = true;
    resetDate(referralDate);
    noReferralReason.disabled = true;
    noReferralReason.value = "";
});

referYesBtn?.addEventListener('click', function () {
    referralStatus(true);
});
referNoBtn?.addEventListener('click', function () {
    referralStatus(false);
});

invalidContact?.addEventListener('click', function () {
    invalidContactValue(invalidContact.checked);
});

proceedBtn?.addEventListener('click', function () {
    applicationStatusValue(true);
});
notProceedBtn?.addEventListener('click', function () {
    applicationStatusValue(false);
});

document.getElementById("hired")?.addEventListener('click', function () {
    employmentStatusValue(this.id);
});
document.getElementById("submitDocs")?.addEventListener('click', function () {
    employmentStatusValue(this.id);
});
document.getElementById("forInterview")?.addEventListener('click', function () {
    employmentStatusValue(this.id);
});
document.getElementById("notHired")?.addEventListener('click', function () {
    employmentStatusValue(this.id);
});

document.getElementById("responded").style.display = "none";
document.getElementById("noResponse").style.display = "none";
proceed.style.display = "none";
notProceed.style.display = "none";

document.getElementById("toggleUpdate1")?.addEventListener('click', function () {
    document.getElementById("confirmationModal").classList.remove('hidden');
});
document.getElementById("toggleUpdate2")?.addEventListener('click', function () {
    document.getElementById("confirmationModal").classList.remove('hidden');
});
document.getElementById("dismissUpdate")?.addEventListener('click', function () {
    document.getElementById("confirmationModal").classList.add('hidden');
});
//#endregion

verificationTab.click();
dateFormatRead();

//#region FUNCTIONS
function openTab(index, tabName) {
    document.querySelectorAll(".tab-content").forEach((tab, i) => {
        tab.classList.toggle("hidden", i !== index);
    });

    document.querySelectorAll("#tabs button").forEach((btn, i) => {
        btn.classList.toggle("border-black", i === index);
        btn.classList.toggle("border-transparent", i !== index);
    });

    if (tabName !== "employment") return;
}

function verificationStatusValue(response) {
    let responded = document.getElementById("responded");
    let noResponse = document.getElementById("noResponse");

    if (response == "responded") {
        responded.style.display = "block";
        noResponse.style.display = "none";
        respondedStatus();
    }
    else if (response == "no response") {
        noResponse.style.display = "block";
        responded.style.display = "none";
        noResponseStatus();
    }
    else {
        responded.style.display = "none";
        noResponse.style.display = "none";
        noVerificationStatus();
    }
}

function respondedStatus() {
    resetDate(document.getElementById("followup1"));
    resetDate(document.getElementById("followup2"));

    invalidContact.checked = false;
    invalidContact.value = "";
    followUpRemarks.value = "";
}

function noResponseStatus() {
    interested.style.display = "none";
    notInterested.style.display = "none";

    interestedBtn.checked = false;
    referralStatusForm.disabled = true;
    referYesBtn.checked = false;
    referNoBtn.checked = false;
    referralDate.disabled = true;
    resetDate(referralDate);
    noReferralReason.disabled = true;
    noReferralReason.value = "";

    notInterestedBtn.checked = false;
    notInterestedReason.disabled = true;
    notInterestedReason.value = "";

    employmentField(true);
}

function noVerificationStatus() {
    interested.style.display = "none";
    notInterested.style.display = "none";

    interestedBtn.checked = false;
    referralStatusForm.disabled = true;
    referYesBtn.checked = false;
    referNoBtn.checked = false;
    referralDate.disabled = true;
    resetDate(referralDate);
    noReferralReason.disabled = true;
    noReferralReason.value = "";

    notInterestedBtn.checked = false;
    notInterestedReason.disabled = true;
    notInterestedReason.value = "";

    resetDate(document.getElementById("followup1"));
    resetDate(document.getElementById("followup2"));

    invalidContact.checked = false;
    invalidContact.value = "";

    employmentField(true);
}

function referralStatus(refer) {
    if (refer == true) {
        referralDate.disabled = false;
        noReferralReason.disabled = true;
        noReferralReason.value = "";
        employmentField(false);
    }
    else {
        noReferralReason.disabled = false;
        referralDate.disabled = true;
        resetDate(referralDate);
        employmentField(true);
    }
}

function invalidContactValue(isChecked) {
    if (isChecked) {
        invalidContact.value = "Yes";
    }
    else {
        invalidContact.value = "";
    }
}

function employmentField(isDisabled) {
    let hiredDate = document.getElementById("hiredDate");
    let submitDocsDate = document.getElementById("submitDocsDate");
    let interviewDate = document.getElementById("interviewDate");
    let notHiredReason = document.getElementById("notHiredReason");
    let notProceedReason = document.getElementById("notProceedReason");
    let remarks = document.getElementById("remarks");

    document.getElementById("employmentField").disabled = isDisabled;

    if (isDisabled) {
        document.getElementById("companyName").value = "";
        document.getElementById("companyAddress").value = "";
        document.getElementById("jobTitle").value = "";

        proceedBtn.checked = false;
        notProceedBtn.checked = false;

        document.getElementById("hired").checked = false;
        document.getElementById("submitDocs").checked = false;
        document.getElementById("forInterview").checked = false;
        document.getElementById("notHired").checked = false;

        hiredDate.disabled = true;
        resetDate(hiredDate);
        submitDocsDate.disabled = true;
        resetDate(submitDocsDate);
        interviewDate.disabled = true;
        resetDate(interviewDate);
        notHiredReason.disabled = true;
        notHiredReason.value = "";
        remarks.disabled = true;
        remarks.value = "";

        notProceedReason.disabled = true;
        notProceedReason.value = "";
    }
}

function applicationStatusValue(canProceed) {
    if (canProceed == true) {
        proceed.style.display = "block";
        notProceed.style.display = "none";
        proceedStatus();
    }
    else {
        notProceed.style.display = "block";
        proceed.style.display = "none";
        notProceedStatus();
    }
}

function proceedStatus() {
    notProceedReason.disabled = true;
    notProceedReason.value = "";

    remarks.disabled = false;
}

function notProceedStatus() {
    notProceedReason.disabled = false;

    document.getElementById("hired").checked = false;
    document.getElementById("submitDocs").checked = false;
    document.getElementById("forInterview").checked = false;
    document.getElementById("notHired").checked = false;

    hiredDate.disabled = true;
    resetDate(hiredDate);
    submitDocsDate.disabled = true;
    resetDate(submitDocsDate);
    interviewDate.disabled = true;
    resetDate(interviewDate);
    notHiredReason.disabled = true;
    notHiredReason.value = "";
    remarks.disabled = true;
    remarks.value = "";
}

function employmentStatusValue(id) {
    let hired = document.getElementById("hiredDate");
    let submitDocs = document.getElementById("submitDocsDate");
    let forInterview = document.getElementById("interviewDate");
    let notHired = document.getElementById("notHiredReason");

    if (id === "hired") {
        hired.disabled = false;
    }
    else {
        hired.disabled = true;
        resetDate(hired);
    }

    if (id === "submitDocs") {
        submitDocs.disabled = false;
    }
    else {
        submitDocs.disabled = true;
        resetDate(submitDocs);
    }

    if (id === "forInterview") {
        forInterview.disabled = false;
    }
    else {
        forInterview.disabled = true;
        resetDate(forInterview);
    }

    if (id === "notHired") {
        notHired.disabled = false;
    }
    else {
        notHired.disabled = true;
        notHired.value = "";
    }
}

function dateFormatRead() {
    let dateFormats = document.getElementsByClassName("dateFormat");
    let year = "";
    let month = "";
    let day = "";

    let monthName = "";
    let dateValue = "";
    for (let dateFormat of dateFormats) {
        dateValue = dateFormat.value;
        if (dateValue == "") {
            continue;
        }

        year = dateValue.slice(0, 4);
        month = dateValue.slice(5, 7);
        day = dateValue.slice(8, 10);

        switch (month) {
            case "01":
                monthName = "January";
                break;

            case "02":
                monthName = "February";
                break;

            case "03":
                monthName = "March";
                break;

            case "04":
                monthName = "April";
                break;

            case "05":
                monthName = "May";
                break;

            case "06":
                monthName = "June";
                break;

            case "07":
                monthName = "July";
                break;

            case "08":
                monthName = "August";
                break;

            case "09":
                monthName = "September";
                break;

            case "10":
                monthName = "October";
                break;

            case "11":
                monthName = "November";
                break;

            case "12":
                monthName = "December";
                break;

            default:
                monthName = "Month"
                break;
        }

        dateFormat.value = `${monthName} ${day}, ${year}`;
    }
}

function resetDate(element) {
    element.value = "";

    // prevent error on older browsers (eg. IE8)
    if (element.type === "date") {
        // update the input content visually
        element.type = "text";
        element.type = "date";
    }
}

function refreshVerification() {
    if (noVerifStatusBtn.checked == true) {
        noVerifStatusBtn.click();
    }
    if (respondedBtn.checked == true) {
        respondedBtn.click();
    }
    if (noResponseBtn.checked == true) {
        noResponseBtn.click();
    }

    if (interestedBtn.checked == true) {
        interestedBtn.click();
    }
    if (notInterestedBtn.checked == true) {
        notInterestedBtn.click();
    }

    if (referYesBtn.checked == true) {
        referYesBtn.click();
    }
    if (referNoBtn.checked == true) {
        referNoBtn.click();
    }
}
//#endregion