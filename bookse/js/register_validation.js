document.addEventListener("DOMContentLoaded", function () {
 
const namePattern = /^[A-Za-z]+$/;
const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
const passwordPattern = /^(?=.*[A-Z])[A-Za-z\d@$!%*?&]{8,}$/;
const usernamePattern = /^[A-Za-z0-9_]{4,}$/;

const addressPattern = /^[A-Za-z0-9\s,'-]*$/;
const cityPattern = /^[A-Za-z\s]*$/;
const statePattern = /^[A-Za-z\s]*$/;
const countryPattern = /^[A-Za-z\s]*$/;
const postalCodePattern = /^[A-Za-z0-9\s]*$/;
const phonePattern = /^[0-9]{10}$/;

const form = document.getElementById("registrationForm");

// Accessing form fields
const firstName = form.querySelector("#firstName");
const lastName = form.querySelector("#lastName");
const email = form.querySelector("#email");
const phoneNumber = form.querySelector("#phoneNumber");
const gender = form.querySelector('input[name="gender"]:checked');
const dateOfBirth = form.querySelector("#dateOfBirth");
const addressLine1 = form.querySelector("#address_line1");
const addressLine2 = form.querySelector("#address_line2");
const city = form.querySelector("#city");
const state = form.querySelector("#state");
const country = form.querySelector("#country");
const postalCode = form.querySelector("#postal_code");
const pickupShippingType = form.querySelector("#pickup_shipping_type");
const username = form.querySelector("#Username");
const password = form.querySelector("#password");
const confirmPassword = form.querySelector("#conpassword");

const firstNameError=document.getElementById("firstNameError");
const lastNameError = document.getElementById("lastNameError");
const emailError = document.getElementById("emailError");
const phoneNumberError = document.getElementById("phoneNumberError");
const genderError = document.getElementById("genderError");
const dateOfBirthError = document.getElementById("dateOfBirthError");
const addressLine1Error = document.getElementById("addressLine1Error");
const addressLine2Error = document.getElementById("addressLine2Error");
const cityError = document.getElementById("cityError");
const stateError = document.getElementById("stateError");
const countryError = document.getElementById("countryError");
const postalCodeError = document.getElementById("postalCodeError");
const pickupShippingTypeError = document.getElementById("pickupShippingTypeError");
const usernameError = document.getElementById("usernameError");
const passwordError = document.getElementById("passwordError");
const confirmPasswordError = document.getElementById("conpasswordError");




form.addEventListener("submit", (event) => {
    event.preventDefault();
    

    if (!namePattern.test(firstName.value)) {
        
        displayErrorMessage("Invalid first name.", firstNameError);
        return;
        console.log("hi")
    } else {
        
        displayErrorMessage("", firstNameError); 
        // Clear the error message
    }

    if (!namePattern.test(lastName.value)) {
        
        displayErrorMessage("Invalid last name.", lastNameError);
        return;
    } else {
        
        displayErrorMessage("", lastNameError); // Clear the error message
    }

    if (!emailPattern.test(email.value)) {
        
        displayErrorMessage("Invalid email address.", emailError);
        return;
    } else {
        
        displayErrorMessage("", emailError); // Clear the error message
    }

    if (!passwordPattern.test(password.value) ) {
        
        displayErrorMessage("Password must be at least 8 characters long and contain at least one capital letter.", passwordError);
        return;
    } else {
        
        displayErrorMessage("", passwordError); // Clear the error message
    } 
    if (!passwordPattern.test(confirmPassword.value) ) {
        
        displayErrorMessage("Password must be at least 8 characters long and contain at least one capital letter.", confirmPasswordError);
        return;
    } else {
        
        displayErrorMessage("", confirmPasswordError); // Clear the error message
    } 

    if (!usernamePattern.test(username.value)) {
        
        displayErrorMessage("Invalid username.", usernameError);
        return;
    } else {
        
        displayErrorMessage("", usernameError); // Clear the error message
    }
    
    if (!addressPattern.test(addressLine1.value)) {
        
        displayErrorMessage("Invalid address.", addressLine1Error);
        return;
    } else {
        
        displayErrorMessage("", addressLine1Error); // Clear the error message
    }

    if (!addressPattern.test(addressLine2.value)) {
        
        displayErrorMessage("Invalid address.", addressLine2Error);
        return;
    } else {
        
        displayErrorMessage("", addressLine2Error); // Clear the error message
    }

    if (!cityPattern.test(city.value)) {
        
        displayErrorMessage("Invalid city name.", cityError);
        return;
    } else {
        
        displayErrorMessage("", cityError); // Clear the error message
    }

    if (!statePattern.test(state.value)) {
        
        displayErrorMessage("Invalid state name.", stateError);
        return;
    } else {
        
        displayErrorMessage("", stateError); // Clear the error message
    }

    if (!countryPattern.test(country.value)) {
        
        displayErrorMessage("Invalid country name.", countryError);
        return;
    } else {
        
        displayErrorMessage("", countryError); // Clear the error message
    }

    if (!postalCodePattern.test(postalCode.value)) {
        
        displayErrorMessage("Invalid postal code.", postalCodeError);
        return;
    } else {
        
        displayErrorMessage("", postalCodeError); // Clear the error message
    }
    if(confirmPassword.value == password.value){
        form.submit();
    }
    else{
        
        displayErrorMessage("passwords not matched",confirmPasswordError);
        return;
    }


    // Similarly, validate other address fields

});
});


function displayErrorMessage(message, errorField) {
    errorField.textContent = message;
}