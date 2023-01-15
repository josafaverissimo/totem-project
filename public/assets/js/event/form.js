function loadImagePreview() {
    const backgroundHandler = document.getElementById("background-handler")
    const backgroundInput = document.getElementById("background")
    const modalFullImage = document.getElementById("modal-full-image")

    if (backgroundInput.files.length === 0) return

    const file = backgroundInput.files[0]
    const fileReader = new FileReader()

    fileReader.readAsDataURL(file)

    fileReader.addEventListener("load", function (event) {
        const result = event.target.result
        backgroundHandler.src = result
        modalFullImage.src = result
    })
}

document.addEventListener("DOMContentLoaded", function (event) {
    const backgroundHandler = document.getElementById("background-handler")
    const backgroundInput = document.getElementById("background")

    backgroundHandler.addEventListener("click", function (event) {
        backgroundInput.click()
    })

    backgroundInput.addEventListener("input", loadImagePreview)
})