function submitForm(form) {
    const validation = formValidation(form)
    const wrapperElement = document.querySelector(form.dataset.wrapperSelector)

    if (validation.required()) {
        wrapperElement.classList.add("my_disabled");

        sendData(form)

        setTimeout(function () {
            wrapperElement.classList.remove("my_disabled");
        }, 2000)
    }
}

function sendData(form) {
    const formData = new FormData()

    formData.append("name", form.name.value)
    formData.append("cpf", form.cpf.value)
    formData.append("cellphone", form.cellphone.value)
    formData.append("address", form.address.value)


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
    })
}

document.addEventListener("DOMContentLoaded", () => {
    const mainForm = document.getElementById('main-form')

    $("#cpf").mask("000.000.000-00")
    $("#cellphone").mask("(00) 0 0000-0000")

    mainForm.addEventListener('submit', event => {
        event.preventDefault()

        submitForm(event.target)
    })

})