function submitForm(form) {
    const validation = formValidation(form)

    if (validation.required()) {
        doLogin(form)
    }
}

function doLogin(form) {
    const formData = new FormData()

    formData.append("user", form.user.value)
    formData.append("password", form.password.value)


    fetch(form.action, {
        method: "post",
        body: formData
    }).then(function (response) {
        return response.json()

    }).then(function (json) {
        if (json.loginOperation) {
            window.location.href = BASE_URL + "eventSelection"
        } else {
            toastify(json.message, "failed")
        }
    })
}

document.addEventListener("DOMContentLoaded", () => {
    const mainForm = document.getElementById('main-form')

    mainForm.addEventListener('submit', event => {
        event.preventDefault()

        submitForm(event.target)
    })

})
