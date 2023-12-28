document.addEventListener("DOMContentLoaded", function () {
    const addressPattern = /^[A-Za-z0-9\s,'-]*$/;
    const cityPattern = /^[A-Za-z\s]*$/;
    const statePattern = /^[A-Za-z\s]*$/;
    const countryPattern = /^[A-Za-z\s]*$/;
    const postalCodePattern = /^[A-Za-z0-9\s]*$/;

    const form = document.getElementById("addressForm");

    // Accessing form fields
    const addressLine1 = form.querySelector("#address_line1");
    const addressLine2 = form.querySelector("#address_line2");
    const city = form.querySelector("#city");
    const state = form.querySelector("#state");
    const country = form.querySelector("#country");
    const postalCode = form.querySelector("#postal_code");
    const pickupShippingType = form.querySelector("#pickup_shipping_type");

    const addressLine1Error = document.getElementById("addressLine1Error");
    const addressLine2Error = document.getElementById("addressLine2Error");
    const cityError = document.getElementById("cityError");
    const stateError = document.getElementById("stateError");
    const countryError = document.getElementById("countryError");
    const postalCodeError = document.getElementById("postalCodeError");
    const pickupShippingTypeError = document.getElementById("pickupShippingTypeError");

    form.addEventListener("submit", function (event) {
        event.preventDefault();
        console.log("hi");

        if (!addressPattern.test(addressLine1.value)) {
            displayErrorMessage("Invalid address.", addressLine1Error);
            return;
        } else {
            displayErrorMessage("", addressLine1Error);
        }

        if (!addressPattern.test(addressLine2.value)) {
            displayErrorMessage("Invalid address.", addressLine2Error);
            return;
        } else {
            displayErrorMessage("", addressLine2Error);
        }

        if (!cityPattern.test(city.value)) {
            displayErrorMessage("Invalid city name.", cityError);
            return;
        } else {
            displayErrorMessage("", cityError);
        }

        if (!statePattern.test(state.value)) {
            displayErrorMessage("Invalid state name.", stateError);
            return;
        } else {
            displayErrorMessage("", stateError);
        }

        if (!countryPattern.test(country.value)) {
            displayErrorMessage("Invalid country name.", countryError);
            return;
        } else {
            displayErrorMessage("", countryError);
        }

        if (!postalCodePattern.test(postalCode.value)) {
            displayErrorMessage("Invalid postal code.", postalCodeError);
            return;
        } else {
            displayErrorMessage("", postalCodeError);
        }

        if (pickupShippingType.value === "") {
            displayErrorMessage("Please select a pickup/shipping type.", pickupShippingTypeError);
            return;
        } else {
            displayErrorMessage("", pickupShippingTypeError);
        }

        // Submit the form if all validations pass
        form.submit();
    });

    function displayErrorMessage(message, errorField) {
        errorField.textContent = message;
    }
});
