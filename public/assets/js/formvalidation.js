function formvalidation(form) {
    const inputs = form.querySelectorAll("input")

    const validation = {
        showError: function (input, message) {
            const inputError = document.querySelector("#" + input.id + "-input-error")

            if (inputError !== null) {
                document.querySelector("#" + input.id + "-input-error").textContent = message
                document.querySelector("#" + input.id + "-input-error").removeAttribute("hidden")
            }
        },
        required: function () {
            function getUnfilledInputs() {
                const inputsRequired = [].filter.call(inputs, function (input) {
                    return input.hasAttribute("required")
                })

                return [].reduce.call(inputsRequired, function (unfilledInputs, input) {
                    if (input.value === "") {
                        unfilledInputs.push(input)
                    }

                    return unfilledInputs
                }, [])
            }

            getUnfilledInputs().forEach(function (input) {
                validation.showError(input, "O campo é obrigatório")
            })
        }
    }

    validation.required()
}