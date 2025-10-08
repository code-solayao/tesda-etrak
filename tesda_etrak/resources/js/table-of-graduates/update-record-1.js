document.addEventListener("DOMContentLoaded", function () {
    const tabDetails = document.getElementById("tabDetails");
    const tabVerification = document.getElementById("tabVerification");
    const tabEmployment = document.getElementById("tabEmployment");

    tabDetails.addEventListener('click', function () {
        openTab(0);
    });
    tabVerification.addEventListener('click', function () {
        openTab(1);

        const interested = document.getElementById("interested");
        const notInterested = document.getElementById("notInterested");
        interested.style.display = "none";
        notInterested.style.display = "none";
        refreshVerification();
    });
    tabEmployment.addEventListener('click', function () {
        openTab(2);
    });
});

function openTab(index) {
    document.querySelectorAll(".tab-content").forEach((tab, i) => {
        tab.classList.toggle("hidden", i !== index);
    });

    document.querySelectorAll("#tabs button").forEach((btn, i) => {
        btn.classList.toggle("border-black", i === index);
        btn.classList.toggle("border-transparent", i !== index);
        btn.classList.toggle("hover:border-gray-300", i !== index);
    });
}

function refreshVerification() {
    const btnNone = document.getElementById("verification_status-0");
    const btnResponded = document.getElementById("verification_status-1");
    const btnNoResponse = document.getElementById("verification_status-2");
    if (btnNone.checked == true) {
        btnNone.click();
    }
    if (btnResponded.checked == true) {
        btnResponded.click();
    }
    if (btnNoResponse.checked == true) {
        btnNoResponse.click();
    }

    const btnInterested = document.getElementById("btnInterested");
    const btnNotInterested = document.getElementById("btnNotInterested");
    if (btnInterested.checked == true) {
        btnInterested.click();
    }
    if (btnNotInterested.checked == true) {
        btnNotInterested.click();
    }

    const btnReferYes = document.getElementById("btnReferYes");
    const btnReferNo = document.getElementById("btnReferNo");
    if (btnReferYes.checked == true) {
        btnReferYes.click();
    }
    if (btnReferNo.checked == true) {
        btnReferNo.click();
    }
}

document.addEventListener("DOMContentLoaded", function () {
    const btnNone = document.getElementById("verification_status-0");
    const btnResponded = document.getElementById("verification_status-1");
    const btnNoResponse = document.getElementById("verification_status-2");

    btnNone.addEventListener('click', function () {
        verificationStatusValue("");
    });
    btnResponded.addEventListener('click', function () {
        verificationStatusValue("responded");
    });
    btnNoResponse.addEventListener('click', function () {
        verificationStatusValue("no response");
    });
});