document.getElementById("toggleDelete").onclick = function () {
    document.getElementById("deleteModal").classList.remove('hidden');
}
document.getElementById("dismissDelete").onclick = function () {
    document.getElementById("deleteModal").classList.add('hidden');
}

document.getElementById("toggleDeleteAll").onclick = function () {
    document.getElementById("deleteAllModal").classList.remove('hidden');
}
document.getElementById("dismissDeleteAll").onclick = function () {
    document.getElementById("deleteAllModal").classList.add('hidden');
}