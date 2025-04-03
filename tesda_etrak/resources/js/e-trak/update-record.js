var verificationTab = document.getElementById("verificationTab");

var respondedBtn = document.getElementById("respondedBtn");
var noResponseBtn = document.getElementById("noResponseBtn");

var interestedBtn = document.getElementById("interestedBtn");
var notInterestedBtn = document.getElementById("notInterestedBtn");

var referralStatusForm = document.getElementById("referralStatusForm");
var referYesBtn = document.getElementById("referYesBtn");
var referNoBtn = document.getElementById("referNoBtn");
var referralDate = document.getElementById("referralDate");
var noReferralReason = document.getElementById("noReferralReason");

var notInterestedReason = document.getElementById("notInterestedReason");

var continuedBtn = document.getElementById("continuedBtn");
var withdrawnBtn = document.getElementById("withdrawnBtn");
var continued = document.getElementById("continued");
var withdrawn = document.getElementById("withdrawn");

document.getElementById("detailsTab").onclick = function () {
    openTab(0);
}
verificationTab.onclick = function () {
    openTab(1);
}
document.getElementById("employmentTab").onclick = function () {
    openTab(2);
}

// document.getElementById("toggleCreate").onclick = function () {
//     document.getElementById("confirmationModal").classList.remove('hidden');
// }
// document.getElementById("dismissCreate").onclick = function () {
//     document.getElementById("confirmationModal").classList.add('hidden');
// }

verificationTab.click();
dateFormatRead();

respondedBtn.onclick = function () {
    verificationStatusValue(true);
}
noResponseBtn.onclick = function () {
    verificationStatusValue(false);
}

interestedBtn.onclick = function () {
    referralStatusForm.disabled = false;
    notInterestedReason.disabled = true;
    notInterestedReason.value = "";
}
document.getElementById("notInterestedBtn").onclick = function () {
    notInterestedReason.disabled = false;
    referralStatusForm.disabled = true;
    referYesBtn.checked = false;
    referNoBtn.checked = false;
    referralDate.disabled = true;
    resetDate(referralDate);
    noReferralReason.disabled = true;
    noReferralReason.value = "";
}

referYesBtn.onclick = function () {
    referralStatus(true);
}
referNoBtn.onclick = function () {
    referralStatus(false);
}

continuedBtn.onclick = function () {
    applicationStatusValue(true);
}
withdrawnBtn.onclick = function () {
    applicationStatusValue(false);
}

document.getElementById("hired").onclick = function () {
    employmentStatusValue(this.id);
}
document.getElementById("submitDocs").onclick = function () {
    employmentStatusValue(this.id);
}
document.getElementById("forInterview").onclick = function () {
    employmentStatusValue(this.id);
}
document.getElementById("notHired").onclick = function () {
    employmentStatusValue(this.id);
}

document.getElementById("responded").style.display = "none";
document.getElementById("noResponse").style.display = "none";
continued.style.display = "none";
withdrawn.style.display = "none";

function openTab(index) {
    document.querySelectorAll(".tab-content").forEach((tab, i) => {
        tab.classList.toggle("hidden", i !== index);
    });

    document.querySelectorAll("#tabs button").forEach((btn, i) => {
        btn.classList.toggle("border-black", i === index);
        btn.classList.toggle("border-transparent", i !== index);
    });
}

function verificationStatusValue(respond) {
    let responded = document.getElementById("responded");
    let noResponse = document.getElementById("noResponse");

    if (respond == true) {
        responded.style.display = "block";
        noResponse.style.display = "none";
        respondedStatus();
    }
    else {
        noResponse.style.display = "block";
        responded.style.display = "none";
        noResponseStatus();
    }
}

function respondedStatus() {
    resetDate(document.getElementById("followup1"));
    resetDate(document.getElementById("followup2"));

    let invalidContact = document.getElementById("invalidContact");
    invalidContact.checked = false;
    invalidContact.value = "";
}

function noResponseStatus() {
    interestedBtn.checked = false;
    referralStatusForm.disabled = true;
    referYesBtn.checked = false;
    referNoBtn.checked = false;
    referralDate.disabled = true;
    resetDate(referralDate);
    noReferralReason.disabled = true;
    noReferralReason.value = "";

    document.getElementById("notInterestedBtn").checked = false;
    notInterestedReason.disabled = true;
    notInterestedReason.value = "";
}

function referralStatus(refer) {
    if (refer == true) {
        referralDate.disabled = false;
        noReferralReason.disabled = true;
        noReferralReason.value = "";
    }
    else {
        noReferralReason.disabled = false;
        referralDate.disabled = true;
        resetDate(referralDate);
    }
}

function employmentField(isDisabled) {
    let withdrawn_reason = document.getElementById("withdrawn_reason");
    let hiredDate = document.getElementById("hiredDate");
    let submitDocsDate = document.getElementById("submitDocsDate");
    let interviewDate = document.getElementById("interviewDate");
    let notHiredReason = document.getElementById("notHiredReason");

    document.getElementById("employmentField").disabled = isDisabled;

    if (isDisabled) {
        document.getElementById("companyName").value = "";
        document.getElementById("companyAddress").value = "";
        document.getElementById("jobTitle").value = "";

        continuedBtn.checked = false;
        withdrawnBtn.checked = false;

        withdrawn_reason.disabled = true;
        withdrawn_reason.value = "";

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
    }
}

function applicationStatusValue(proceed) {
    if (proceed == true) {
        continued.style.display = "block";
        withdrawn.style.display = "none";
        continuedStatus();
    }
    else {
        withdrawn.style.display = "block";
        continued.style.display = "none";
        withdrawnStatus();
    }
}

function continuedStatus() {
    let withdrawn_reason = document.getElementById("withdrawn_reason");
    withdrawn_reason.disabled = true;
    withdrawn_reason.value = "";
}

function withdrawnStatus() {
    withdrawn_reason.disabled = false;

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
    for (let dateFormat of dateFormats) {
        let dateValue = dateFormat.value;
        if (dateValue == "" || !isValidDateStrict(dateValue)) {
            if (dateValue.length > 11) {
                let sliced = dateValue.slice(0, 11);
                dateFormat.value = sliced;
            }
            continue;
        }

        dateValue = dateFormat.value;
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

function isValidDateStrict(dateString) {
    const regex = /^\d{4}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01])$/;
    if (!regex.test(dateString)) return false;

    const date = new Date(dateString);
    const [year, month, day] = dateString.split("-").map(Number);

    return date.getFullYear() === year && 
           date.getMonth() + 1 === month && 
           date.getDate() === day;
}