function submitForm(form) {
    const validation = formValidation(form)

    if (validation.required()) {
        doCreate(form)
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
            toastify(json.message, "failed")
        }

    })
}

document.addEventListener("DOMContentLoaded", () => {
    const mainForm = document.getElementById('main-form')

    mainForm.addEventListener('submit', event => {
        event.preventDefault()

        // submitForm(event.target)
        doCreate(event.target)
    })

})