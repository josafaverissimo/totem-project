function doCreate(form) {
    const formData = new FormData()
    
    formData.append("name", form.name.value)
    formData.append("cpf", form.cpf.value)
    formData.append("cellphone", form.cellphone.value)
    formData.append("password", form.password.value)


    fetch(BASE_URL + "/user/create", {
        method: "post",
        body: formData
    }).then(response => response.json())
    .then(json => console.log(json))
}

document.addEventListener("DOMContentLoaded", () => {
    const mainForm = document.getElementById('main-form')

    mainForm.addEventListener('submit', event => {
        event.preventDefault()

        doCreate(event.target)
    })
})