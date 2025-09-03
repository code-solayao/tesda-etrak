document.addEventListener("DOMContentLoaded", function () {
    let buttons = document.querySelectorAll(".delete-buttons");
    let form = document.getElementById("deleteForm");

    buttons.forEach(function (button) {
        button.addEventListener("click", function (event) {
            const value = event.currentTarget.getAttribute("data-value");
            form.action = `/admin/table-of-graduates/record-details/${value}`;
            document.getElementById("deleteModal").classList.remove('hidden');
        });
    });
});

document.getElementById("dismissDelete").onclick = function () {
    document.getElementById("deleteModal").classList.add('hidden');
}

document.getElementById("toggleDeleteAll").onclick = function () {
    document.getElementById("deleteAllModal").classList.remove('hidden');
}
document.getElementById("dismissDeleteAll").onclick = function () {
    document.getElementById("deleteAllModal").classList.add('hidden');
}