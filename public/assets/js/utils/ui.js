
// Show a custom alert
 window.showAlert = (title, text, icon)  => {
    return Swal.fire({
        title,
        text,
        icon,
        confirmButtonText: "OK"
    });
}

// Show loading state
 window.showLoadingAlert = (message = "Loading...")  => {
    return Swal.fire({
        title: message,
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        },
    });
}

// Toggle button state (enable/disable)
 window.setButtonState = (button, isDisabled, text)  => {
    button.disabled = isDisabled;
    button.textContent = text;
}
