document.addEventListener("DOMContentLoaded", function () {
    let bodyRows = document.querySelectorAll(".body-row");
    let deleteBtns = document.querySelectorAll(".delete-button");
    let form = document.getElementById("deleteForm");

    bodyRows.forEach(function (row) {
        row.addEventListener('dblclick', function () {
            window.location = row.dataset.url;
        });
    });

    document.querySelectorAll(".action-select").forEach(select => {
        select.addEventListener("change", function (event) {
            event.stopPropagation();
            const id = select.dataset.id;
            const value = select.value;
            const option = select.options[select.selectedIndex];

            if (value === "view" || value === "update") {
                window.location = option.dataset.url;
            }

            if (value === "delete") {
               form.action = `/admin/table-of-graduates/record-details/${id}`; 
               document.getElementById("deleteModal").classList.remove('hidden');
            }

            select.value = "";
        });
    });
    // deleteBtns.forEach(function (button) {
    //     button.addEventListener("click", function (event) {
    //         const value = event.currentTarget.getAttribute("data-value");
    //         form.action = `/admin/table-of-graduates/record-details/${value}`;
    //         document.getElementById("deleteModal").classList.remove('hidden');
    //     });
    // });
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