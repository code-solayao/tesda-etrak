document.getElementById("detailsTab").onclick = function() {
    openTabPage(`details`, this, `#7fbafa`, `white`);
}
document.getElementById("verificationTab").onclick = function () {
    openTabPage(`verification`, this, `#7fbafa`, `white`);
}
document.getElementById("employmentTab").onclick = function () {
    openTabPage(`employment`, this, `#7fbafa`, `white`);
}

document.getElementById("detailsTab").click();

document.getElementById("employmentTab").disabled = false;
//hideShowTab();
dateFormatRead();

function openTabPage(name, element, backgroundColor, color) {
    let tabcontents;
    let tablinks;

    // Hide all elements with class="tabcontent" by default
    tabcontents = document.getElementsByClassName("tabcontent");
    for (let i = 0; i < tabcontents.length; i++) {
        tabcontents[i].style.display = "none";
    }

    // Remove the background color of all tablinks/buttons
    tablinks = document.getElementsByClassName("tablink");
    for (let i = 0; i < tablinks.length; i++) {
        tablinks[i].style.backgroundColor = "";
        tablinks[i].style.color = "white";
    }

    // Show the specific tab content
    document.getElementById(name).style.display = "block";

    // Add the specific color to the button used to open the tab content
    element.style.backgroundColor = backgroundColor;
    element.style.color = color;
}

function hideShowTab() {
    let referralStatus = document.getElementById("referralStatus");
    let employmentTab = document.getElementById("employmentTab");

    if (referralStatus == null) {
        return;
    }

    if (referralStatus.textContent === "Yes") {
        employmentTab.disabled = false;
    }
    else {
        employmentTab.disabled = true;
    }
}

function dateFormatRead() {
    let dateFormats = document.getElementsByClassName("dateFormat");
    let year = "";
    let month = "";
    let day = "";

    let monthName = "";
    for (let dateFormat of dateFormats) {
        if (dateFormat.textContent == "" || !isValidDateStrict(dateFormat.textContent)) {
            if (dateFormat.textContent.length > 11) {
                let sliced = dateFormat.textContent.slice(0, 11);
                dateFormat.textContent = sliced;
            }
            continue;
        }

        year = dateFormat.textContent.slice(0, 4);
        month = dateFormat.textContent.slice(5, 7);
        day = dateFormat.textContent.slice(8, 10);

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

        dateFormat.textContent = `${monthName} ${day}, ${year}`;
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