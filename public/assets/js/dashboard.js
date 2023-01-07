function deleteRow(button) {
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

document.addEventListener("DOMContentLoaded", function () {
    const contextMenu = document.querySelector(".table-actions-wrapper")

    document.addEventListener("click", function (event) {
        const isInContextMenu = event.target.closest(".table-actions-wrapper") === null

        if (isInContextMenu) {
            contextMenu.setAttribute("hidden", "")
        }
    })

    //td.text-center is only a warning
    document.querySelectorAll("td:not([class='text-center'])").forEach(function (td) {
        td.addEventListener("contextmenu", function (event) {
            event.preventDefault()

            const hash = event.target.closest("[data-hash]").dataset.hash
            const baseurlActions = event.target.closest("[data-baseurl-actions]").dataset.baseurlActions
            const deleteModal = event.target.closest("[data-delete-modal]").dataset.deleteModal

            contextMenu.setAttribute("data-hash", hash)
            contextMenu.setAttribute("data-baseurl-actions", baseurlActions)
            contextMenu.setAttribute("data-delete-modal", deleteModal)

            let x = event.clientX
            let y = event.clientY

            let windowWidth = window.innerWidth
            let windowHeight = window.innerHeight
            let contextMenuWidth = contextMenu.offsetWidth
            let contextMenuHeight = contextMenu.offsetHeight

            x = x > windowWidth - contextMenuWidth ? windowWidth - contextMenuWidth : x
            y = y > windowHeight - contextMenuHeight ? windowHeight - contextMenuHeight : y

            contextMenu.style.left = `${x}px`
            contextMenu.style.top = `${y}px`
            contextMenu.removeAttribute("hidden")
        })
    })

    contextMenu.querySelector("li.edit").addEventListener("click", function (event) {
        const baseurl = event.target.closest("[data-baseurl-actions]").dataset.baseurlActions
        const hash = event.target.closest("[data-hash]").dataset.hash
        const target = baseurl + "/" + "form/" + hash

        window.location.href = target
    })

    contextMenu.querySelector("li.delete").addEventListener("click", function (event) {
        const baseurl = event.target.closest("[data-baseurl-actions]").dataset.baseurlActions
        const hash = event.target.closest("[data-hash]").dataset.hash
        const deleteModalId = event.target.closest("[data-delete-modal]").dataset.deleteModal
        const deleteModal = document.getElementById(deleteModalId)
        const target = baseurl + "/" + "delete/" + hash

        const deleteModalRow = deleteModal.querySelector(".delete-modal-row")
        const row = document.querySelector('[data-hash="' + hash + '"]')
        const colsAllowed = deleteModalRow.dataset.cols === undefined ?
            null :
            deleteModalRow.dataset.cols.split(",").map(function (col) {
                return Number(col)
            })

        row.setAttribute("id", "delete-row")

        deleteModalRow.innerHTML = ''
        row.querySelectorAll("td").forEach(function (td, index) {
            if (colsAllowed !== null) {
                if (colsAllowed.indexOf(index) !== -1) {
                    const data = td.textContent
                        .replace(/ +/g, " ")
                        .replace(/^ /, "")

                    const newTdElement = document.createElement("td")
                    newTdElement.textContent = data

                    deleteModalRow.append(newTdElement)
                }
            } else {
                const data = td.textContent
                    .replace(/ +/g, " ")
                    .replace(/^ /, "")

                const newTdElement = document.createElement("td")
                newTdElement.textContent = data

                deleteModalRow.append(newTdElement)
            }
        })

        $(deleteModal).modal("show")
    })
})