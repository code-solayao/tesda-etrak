document.addEventListener("DOMContentLoaded", function () {
    let bodyRows = document.querySelectorAll(".body-row");

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
               form.action = `/admin/list-of-graduates/record-details/${id}`; 
               document.getElementById("deleteModal").classList.remove('hidden');
            }

            select.value = "";
        });
    });
});