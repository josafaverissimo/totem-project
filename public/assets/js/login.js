function doLogin(form) {
    const formData = new FormData()

    formData.append("user", form.user.value)
    formData.append("password", form.password.value)


    fetch(form.action, {
        method: "post",
        body: formData
    }).then(response => response.json())
        .then(json => {
            if (json.login_status) {
                window.location.href = BASE_URL + "dashboard"
            }
        })
}

document.addEventListener("DOMContentLoaded", () => {
    const mainForm = document.getElementById('main-form')

    mainForm.addEventListener('submit', event => {
        event.preventDefault()

        // doLogin(event.target)
        formvalidation(event.target)
    })

})
