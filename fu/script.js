// Display a success message popup
function showSuccessMessage(message) {
    const successPopup = document.getElementById('success-popup');
    successPopup.innerText = message;
    successPopup.style.display = 'block';
    setTimeout(() => {
        successPopup.style.display = 'none';
    }, 3000);
}

// Display an error message popup
function showErrorMessage(message) {
    const errorPopup = document.getElementById('error-popup');
    errorPopup.innerText = message;
    errorPopup.style.display = 'block';
    setTimeout(() => {
        errorPopup.style.display = 'none';
    }, 3000);
}
