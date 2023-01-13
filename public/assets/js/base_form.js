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

    document.querySelectorAll("input:not([type='radio']),input:not([type='file']),select:not([multiple])")
        .forEach(function (field) {
            formData.append(field.name, field.value)
        })

    document.querySelectorAll("input[type='file']").forEach(function (input) {
        [].forEach.call(input.files, function (file) {
            formData.append(input.name, file)
        })
    })

    document.querySelectorAll("select[multiple]").forEach(function (select) {
        select.querySelectorAll("option").forEach(function (option) {
            if (option.selected) {
                formData.append(select.name, option.value)
            }
        })
    })

    document.querySelectorAll("input[type='radio']").forEach(function (input) {
        if (input.checked) {
            formData.append(input.name, input.value)
        }
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

    $("input[data-mask]").each(function (index, input) {
        $(input).mask(input.dataset.mask)
    })

    mainForm.addEventListener('submit', function (event) {
        event.preventDefault()

        submitForm(event.target)
    })

    document.querySelectorAll(".select2").forEach(function (select) {
        $(select).select2()
    })
})