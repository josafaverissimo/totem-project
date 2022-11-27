function doLogin(form) {
    const formData = new FormData()
    
    formData.append("email", form.email.value)
    formData.append("password", form.password.value)


    fetch("http://localhost:8080/totem-project/login/doLogin", {
        method: "post",
        body: formData
    }).then(response => response.json())
    .then(json => console.log(json))
}

document.addEventListener("DOMContentLoaded", () => {
    const mainForm = document.getElementById('main-form')

    mainForm.addEventListener('submit', event => {
        event.preventDefault()

        doLogin(event.target)
    })
})