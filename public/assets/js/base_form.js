function submitForm(form) {
    const validation = formValidation(form)
    const wrapperElement = document.querySelector(form.dataset.wrapperSelector)

    if (validation.required()) {
        wrapperElement.classList.add("my-disabled");

        sendData(form)

        setTimeout(function () {
            wrapperElement.classList.remove("my-disabled");
        }, 2000)
    }
}

function sendData(form) {
    const formData = new FormData()

    document.querySelectorAll("input").forEach(function (input) {
        formData.append(input.name, input.value)
    })

    fetch(form.action, {
        method: "post",
        body: formData
    }).then(function (response) {
        return response.json()

    }).then(function (json) {
        if (json.messages) {
            Object.keys(json.messages).forEach(function (status) {
                json.messages[status].forEach(function (message) {
                    toastify(message, status)
                })
            })
        }

        if (json.formValidation) {
            Object.keys(json.formValidation).forEach(function (field) {
                toastify(json.formValidation[field], "failed");
            })
        }

        if (json.success) {
            setTimeout(function () {
                window.location.href = form.dataset.redirect
            }, 1500)
        }
    })
}

document.addEventListener("DOMContentLoaded", function (event) {
    const mainForm = document.getElementById("main-form")

    mainForm.addEventListener('submit', function (event) {
        event.preventDefault()

        submitForm(event.target)
    })
})