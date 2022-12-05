function submitForm(form) {
    const validation = formValidation(form)
    const wrapperElement = document.querySelector(form.dataset.wrapperSelector)

    if (validation.required()) {
        wrapperElement.classList.add("disabled");

        doCreate(form)

        setTimeout(function () {
            wrapperElement.classList.remove("disabled");
        }, 2000)
    }
}

function doCreate(form) {
    const formData = new FormData()

    formData.append("name", form.name.value)
    formData.append("cpf", form.cpf.value)
    formData.append("cellphone", form.cellphone.value)
    formData.append("password", form.password.value)


    fetch(form.action, {
        method: "post",
        body: formData
    }).then(function (response) {
        return response.json()

    }).then(function (json) {
        if (json.success) {
            toastify(json.message, "success")
        } else {
            if (json.formValidation) {
                Object.keys(json.formValidation).forEach(function (field) {
                    toastify(json.formValidation[field], "failed");
                })
            } else {
                toastify(json.message, "failed")
            }
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