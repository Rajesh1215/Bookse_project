
<div class="container shadow rounded-5 m-5 p-5">
    <div class="form-container">
        <h1 class="mb-4">You didn't have a seller account. Create it right now.</h1>

        <form action="creastesell.php" method="post" id="sellingAccountForm" >
            <div class="m-3 px-5">
                <div class="form-group">
                    <label for="accountNo">Account No:</label>
                    <input type="text" class="form-control" id="editBankAccount" name="accountNo" required>
                    <div class="invalid" id="bankAccountError"></div>    
                </div>

                <div class="form-group">
                    <label for="upiId">UPI ID:</label>
                    <input type="text" class="form-control" id="editUpiID" name="upiId" required>
                    <div class="invalid" id="upiIDError"></div>
                </div>
            </div>
            <center>
                <button type="submit" class="btn btn-primary">Create Account</button>
            </center>   
        </form>
    </div>
</div>

