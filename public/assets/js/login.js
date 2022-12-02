function doLogin(form) {
    const formData = new FormData()
    
    formData.append("email", form.email.value)
    formData.append("password", form.password.value)


    fetch(BASE_URL + "/login/doLogin", {
        method: "post",
        body: formData
    }).then(response => response.json())
    .then(json => {
        if(json.login_status) {
            window.location.href = BASE_URL + "/dashboard"
        }
    })
}

document.addEventListener("DOMContentLoaded", () => {
    const mainForm = document.getElementById('main-form')

    mainForm.addEventListener('submit', event => {
        event.preventDefault()

        doLogin(event.target)
    })
})
