document.addEventListener("DOMContentLoaded", function () {

    const form2 = document.querySelector('#editModal form');
    const usernameInput = document.getElementById('username');
    const firstNameInput = document.getElementById('first_name');
    const lastNameInput = document.getElementById('last_name');
    const emailInput = document.getElementById('email');
    const dobInput = document.getElementById('date_of_birth');
    const genderInput = document.getElementById('gender');
    const phoneNumberInput = document.getElementById('phone_number');
    const secondaryPhoneNumberInput = document.getElementById('secondary_phone_number');
    const currentPasswordInput = document.getElementById('current_password');
    const newPasswordInput = document.getElementById('new_password');
    const confirmPasswordInput = document.getElementById('confirm_password');

    const namePattern = /^[A-Za-z]+$/;
    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    const passwordPattern = /^((?=.*[A-Z])[A-Za-z\d@$!%*?&]{8,})?$/;
    const usernamePattern = /^[A-Za-z0-9_]{4,}$/;
    const phonePattern = /^[0-9]{10}$/;


    form2.addEventListener('submit', function (event) {
        event.preventDefault();
        let valid = true;

        if (!usernamePattern.test(usernameInput.value)) {
            document.getElementById('usernameError').textContent = 'Username is invalid.';
            valid = false;
        } else {
            document.getElementById('usernameError').textContent = '';
        }

        if (!namePattern.test(firstNameInput.value)) {
            document.getElementById('firstNameError').textContent = 'First name is invalid.';
            valid = false;
        } else {
            document.getElementById('firstNameError').textContent = '';
        }

        if (!namePattern.test(lastNameInput.value)) {
            document.getElementById('lastNameError').textContent = 'Last name is invalid.';
            valid = false;
        } else {
            document.getElementById('lastNameError').textContent = '';
        }

        if (!emailPattern.test(emailInput.value)) {
            document.getElementById('emailError').textContent = 'Email is invalid.';
            valid = false;
        } else {
            document.getElementById('emailError').textContent = '';
        }

        if (!dobInput.value) {
            document.getElementById('dobError').textContent = 'Date of birth is invalid.';
            valid = false;
        } else {
            document.getElementById('dobError').textContent = '';
        }

        if (!(genderInput.value)) {
            document.getElementById('genderError').textContent = 'Gender is invalid.';
            valid = false;
        } else {
            document.getElementById('genderError').textContent = '';
        }

        if (!phonePattern.test(phoneNumberInput.value)) {
            document.getElementById('phoneNumberError').textContent = 'Phone number is invalid.';
            valid = false;
        } else {
            document.getElementById('phoneNumberError').textContent = '';
        }

        if (!phonePattern.test(secondaryPhoneNumberInput.value)) {
            document.getElementById('secondaryPhoneNumberError').textContent = 'Secondary phone number is invalid.';
            valid = false;
        } else {
            document.getElementById('secondaryPhoneNumberError').textContent = '';
        }

        

        if (!passwordPattern.test(currentPasswordInput.value)) {
            document.getElementById('currentPasswordError').textContent = 'Current password is invalid.';
            valid = false;
        } else {
            document.getElementById('currentPasswordError').textContent = '';
        }

        if (!passwordPattern.test(newPasswordInput.value)) {
            document.getElementById('newPasswordError').textContent = 'New password is invalid.';
            valid = false;
        } else {
            document.getElementById('newPasswordError').textContent = '';
            if(!currentPasswordInput.value){
                if( !newPasswordInput.value){

                }
                else{
                    document.getElementById('currentPasswordError').textContent = 'Enter password';
                valid = false;
                }
            }
            
        }

        if (newPasswordInput.value !== confirmPasswordInput.value) {
            document.getElementById('confirmPasswordError').textContent = 'Passwords do not match.';
            valid = false;
        } else {
            document.getElementById('confirmPasswordError').textContent = '';
        }

        if (valid) {
            form2.submit();
        }

    });

});
