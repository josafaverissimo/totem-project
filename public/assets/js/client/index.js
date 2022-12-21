function deleteClient(button) {
    const form = document.querySelector("#main-table")
    const hash = button.dataset.hash
    const action = button.dataset.action

    form.classList.add("my-disabled")

    if (hash !== "") {
        const formData = new FormData()

        formData.append("hash", hash)

        fetch(action + "/" + hash, {
            method: "post",
            body: formData
        }).then(function (response) {
            return response.json()

        }).then(function (json) {
            if (json.success) {
                mainDatatable.row($("#delete-row")).remove().draw()
                $("#delete-modal").modal("hide")
            } else {
                document.getElementById("delete-row").removeAttribute("id")
            }

            if (json.messages) {
                Object.keys(json.messages).forEach(function (status) {
                    json.messages[status].forEach(function (message) {
                        toastify(message, status)
                    })
                })
            }
        })

        setTimeout(function () {
            form.classList.remove("my-disabled")
        }, 1500)
    }
}