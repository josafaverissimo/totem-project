document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('tr[data-action]').forEach(function (tr) {
        tr.addEventListener("click", function (event) {
            window.location.href = tr.dataset.action
        })
    })
})