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

function searchCep() {
    const cep = document.getElementById("cep").value
    const cepRegexValidation = new RegExp("[0-9]{5}-[0-9]{3}")
    const cepValidation = cepRegexValidation.test(cep)

    if (!cepValidation) {
        toastify("Cep inválido", "failed")
        return
    }

    const fieldsIdToDisable = ["state", "city", "address", "neighborhood"]
    const target = "https://brasilapi.com.br/api/cep/v1/" + cep

    fieldsIdToDisable.forEach(function (fieldId) {
        document.querySelector("#" + fieldId).parentNode.classList.add("my-disabled")
    })

    fetch(target).then(function (response) {
        return response.json()
    }).then(function (json) {
        if (json.errors) {
            toastify("Cep inválido", "failed")
            return
        }
        replaceAddressInputs({
            state: json.state,
            city: json.city,
            address: json.street,
            neighborhood: json.neighborhood
        })
    }).then(function () {
        setTimeout(function () {
            fieldsIdToDisable.forEach(function (fieldId) {
                document.querySelector("#" + fieldId).parentNode.classList.remove("my-disabled")
            })
        }, 1000)
    })
}

function replaceAddressInputs(addressData) {
    const state = document.getElementById("state")
    const city = document.getElementById("city")
    const address = document.getElementById("address")
    const neighborhood = document.getElementById("neighborhood")

    state.value = addressData.state
    city.value = addressData.city
    address.value = addressData.address
    neighborhood.value = addressData.neighborhood
}

document.addEventListener("DOMContentLoaded", () => {
    const mainForm = document.getElementById('main-form')

    $("input[data-mask]").each(function (index, input) {
        $(input).mask(input.dataset.mask)
    })

    mainForm.addEventListener('submit', event => {
        event.preventDefault()

        submitForm(event.target)
    })

    document.getElementById("search-cep").addEventListener("click", function (event) {
        searchCep()
    })
})