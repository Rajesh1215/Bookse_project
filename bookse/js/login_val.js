document.addEventListener("DOMContentLoaded", function () {
    // Your JavaScript code here

const loginForm = document.getElementById("loginForm");
const logUsername = document.getElementById("loginusername");
const logPassword = document.getElementById("loginpassword");
const logusernameError = document.getElementById("loginusernameError");
const logpasswordError = document.getElementById("loginpasswordError");

const usernamePatternlogin = /^[A-Za-z0-9_]{4,}$/;
const passwordPatternlogin = /^(?=.*[A-Z])[A-Za-z\d@$!%*?&]{8,}$/;


loginForm.addEventListener("submit", (event) => {
    event.preventDefault();

    if (!usernamePatternlogin.test(logUsername.value)) {
        displayErrorMessage("Invalid username.", logusernameError);
    } else {
        displayErrorMessage("", logusernameError); // Clear the error message

    }

    if (!passwordPatternlogin.test(logPassword.value)) {
        displayErrorMessage("Invalid password.", logpasswordError);

    } else {
        displayErrorMessage("", logpasswordError); // Clear the error message

    }

    // Submit the form if there are no errors
    if (usernamePatternlogin.test(logUsername.value) && passwordPatternlogin.test(logPassword.value)) {
        console.log("hi");
        loginForm.submit();
    }
    
});

});


function displayErrorMessage(message, errorField) {
    errorField.textContent = message;
}