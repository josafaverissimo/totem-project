function formValidation(form) {
    const inputs = form.querySelectorAll("input")

    function getTextError(inputId) {
        return document.querySelector("#" + inputId + "-input-error")
    }

    function showError(input, message) {
        const textError = getTextError(input.id)

        if (textError !== null) {
            input.classList.add("input-error")
            textError.textContent = message
            textError.removeAttribute("hidden")
        }
    }

    function hiddenError(input) {
        const textError = getTextError(input.id)

        if (textError !== null) {
            input.classList.remove("input-error")
            textError.setAttribute("hidden", "")
        }
    }

    const validation = {
        required: function () {
            function getRequiredInputs() {
                return [].filter.call(inputs, function (input) {
                    return input.hasAttribute("required")
                })
            }

            function getUnfilledInputs() {
                const requiredInputs = getRequiredInputs()

                return [].reduce.call(requiredInputs, function (unfilledInputs, input) {
                    if (input.value === "") {
                        unfilledInputs.push(input)
                    }

                    return unfilledInputs
                }, [])
            }

            function getFilledInputs() {
                const requiredInputs = getRequiredInputs()

                return [].reduce.call(requiredInputs, function (filledInputs, input) {
                    if (input.value !== "") {
                        filledInputs.push(input)
                    }

                    return filledInputs
                }, [])
            }

            function showRequiredError(input) {
                showError(input, "O campo é obrigatório")
            }

            const unfilledInputs = getUnfilledInputs()
            const filledInputs = getFilledInputs()

            if (filledInputs.length !== 0) {
                filledInputs.forEach(hiddenError)
            }

            if (unfilledInputs.length !== 0) {
                unfilledInputs.forEach(showRequiredError)

                toastify("Há erros no formulário", "failed")

                return false
            }

            return true
        }
    }

    return validation
}
