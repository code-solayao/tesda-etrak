import '../bootstrap';

var confirmationModal = document.getElementById("confirmationModal");

document.getElementById("btnCreate")?.addEventListener("click", function () {
    confirmationModal.classList.replace("hidden", "block");
});

document.getElementById("btnCancel")?.addEventListener("click", function () {
    confirmationModal.classList.replace("block", "hidden");
});