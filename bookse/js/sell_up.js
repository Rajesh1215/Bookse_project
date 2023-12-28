
    
document.addEventListener("DOMContentLoaded", function () {
    const bankAccountPattern = /^\d{10}$/;
    const upiIDPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+(\.[a-zA-Z]{2,})?$/;

    const form4 = document.getElementById("sellingAccountForm");
    const bankAccount = form4.querySelector("#editBankAccount");
    const upiID = form4.querySelector("#editUpiID");
    
    const bankAccountError = document.getElementById("bankAccountError");
    const upiIDError = document.getElementById("upiIDError");

    form4.addEventListener("submit", (event) => {
        event.preventDefault();

        if (!bankAccountPattern.test(bankAccount.value)) {
            displayErrorMessage("Invalid bank account.", bankAccountError);
            console.log("bank");
            return;
        } else {
            displayErrorMessage("", bankAccountError);
            console.log("bankn");
        }

        if (!upiIDPattern.test(upiID.value)) {
            displayErrorMessage("Invalid UPI ID.", upiIDError);
            console.log("upi");
            return;
        } else {
            displayErrorMessage("", upiIDError);
            console.log("upin");
        }

        // If validation passes, submit the form4
        form4.submit();
        
    });

    function displayErrorMessage(message, errorField) {
        errorField.textContent = message;
    }
});

