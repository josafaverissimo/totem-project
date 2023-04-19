function toastify(message, status, gravity, position) {
    gravity = gravity === undefined ? "top" : gravity
    position = position === undefined ? "center" : position;

    const gradients = {
        failed: "linear-gradient(to right, #9b000b, #cd000b)",
        success: "linear-gradient(to right, #009b00, #00cd00)"
    }

    Toastify({
        text: message,
        gravity: gravity,
        position: position,
        duration: 5000,
        style: {
            background: gradients[status]
        }
    }).showToast();
}