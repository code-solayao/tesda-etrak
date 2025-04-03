document.getElementById("toggleCreate").onclick = function () {
    document.getElementById("confirmationModal").classList.remove('hidden');
}
document.getElementById("dismissCreate").onclick = function () {
    document.getElementById("confirmationModal").classList.add('hidden');
}