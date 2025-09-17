// document.addEventListener("DOMContentLoaded", function () {
//     let bodyRows = document.querySelectorAll(".body-row");
//     let form = document.getElementById("deleteForm");

//     bodyRows.forEach(function (row) {
//         row.addEventListener('dblclick', function () {
//             window.location = row.dataset.url;
//         });
//     });

//     document.querySelectorAll(".action-select").forEach(select => {
//         select.addEventListener("change", function (event) {
//             event.stopPropagation();
//             const id = select.dataset.id;
//             const value = select.value;
//             const option = select.options[select.selectedIndex];

//             if (value === "view" || value === "update") {
//                 window.location = option.dataset.url;
//             }

//             if (value === "delete") {
//                form.action = `/admin/list-of-graduates/record-details/${id}`; 
//                document.getElementById("deleteModal").classList.remove('hidden');
//             }

//             select.value = "";
//         });
//     });
// });

// document.getElementById("dismissDelete").addEventListener('click', function () {
//     document.getElementById("deleteModal").classList.add("hidden");
// });

// document.getElementById("toggleDeleteAll").addEventListener('click', function () {
//     document.getElementById("deleteAllModal").classList.remove("hidden");
// });

// document.getElementById("dismissDeleteAll").addEventListener('click', function () {
//     document.getElementById("deleteAllModal").classList.add("hidden");
// });
