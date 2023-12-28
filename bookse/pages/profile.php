<?php include "../includes/auto_auth.php"; ?>

<?php include '../includes/header.php'; ?>
<?php include "../config/database.php"; ?>



<?php

$user_id = $_SESSION['user_id'];
$query = "select * from users where user_id=$user_id;";
$querysell = "select * from sellers where user_id=$user_id;";
$resultsell = mysqli_query($conn, $querysell);
$result = mysqli_query($conn, $query);
$userdetails = mysqli_fetch_assoc($result);
$s = mysqli_num_rows($resultsell);
$sellerdetails = mysqli_fetch_assoc($resultsell);
// Replace with the desired user ID


// Query to retrieve addresses for the user from the 'address' table
$address_query = "SELECT * FROM addresses WHERE user_id = $user_id";
$address_result = mysqli_query($conn, $address_query);

// Query to retrieve phone numbers for the user from the 'phonenumbers' table
$phone_query = "SELECT * FROM phonenumbers WHERE user_id = $user_id";
$phone_result = mysqli_query($conn, $phone_query);
?>
<div class="container">
    <div class="row shadow rounded-3 m-2 p-2 bg-white">
        <div class="d-flex justify-content-between ">
            <h3>Account details</h3>
            <button type="button" class="btn btn-link p-0" data-bs-toggle="modal" data-bs-target="#editModal">
                <i class="fas fa-cog fa-lg m-2 text-dark"></i>
            </button>
        </div>

        <hr class="my-2">
        <div class="col-md-5 col-sm-12  ">
            <div class="row justify-content-between">
                <strong class="col-6">Username</strong>
                <p class="col-6">
                    <?php echo $userdetails["username"] ?>
                </p>
            </div>
            <div class="row justify-content-between">
                <strong class="col-6">UserID</strong>
                <p class="col-6">
                    <?php echo $userdetails["user_id"] ?>
                </p>
            </div>
            <div class="row justify-content-between">
                <strong class="col-6">Password</strong>
                <p class="col-6">........</p>
            </div>
            <div class="row justify-content-between">
                <strong class="col-6">Email</strong>
                <p class="col-6">
                    <?php echo $userdetails["email"] ?>
                </p>
            </div>
            <div class="row justify-content-between">
                <strong class="col-6">Phone no.</strong>
                <p class="col-6">
                    <?php
                    $ph = mysqli_fetch_assoc($phone_result);
                    echo $ph["phone_number"] ?>
                </p>
            </div>
        </div>
        <div class="col-md-5 col-sm-12  ">

            <div class="row justify-content-between">
                <strong class="col-6">First Name</strong>
                <p class="col-6">
                    <?php echo $userdetails["first_name"] ?>
                </p>
            </div>
            <div class="row justify-content-between">
                <strong class="col-6">Last Name</strong>
                <p class="col-6">
                    <?php echo $userdetails["last_name"] ?>
                </p>
            </div>
            <div class="row justify-content-between">
                <strong class="col-6">Date of Birth</strong>
                <p class="col-6">
                    <?php echo $userdetails["date_of_birth"] ?>
                </p>
            </div>
            <div class="row justify-content-between">
                <strong class="col-6">Gender</strong>
                <p class="col-6">
                    <?php echo $userdetails["gender"] ?>
                </p>
            </div>
            <div class="row justify-content-between">
                <strong class="col-6">Secondary Phone no.</strong>
                <p class="col-6">
                    <?php
                    $ph2 = mysqli_fetch_assoc($phone_result);
                    echo $ph["phone_number"] == '' ? $ph["phone_number"] : "None" ?>
                </p>
            </div>
        </div>
    </div>

    <div class=" shadow rounded-3 m-2 p-2 bg-white">
        <div class="d-flex justify-content-between align-items-center mx-4">
            <h3>Address</h3>
            <button data-bs-toggle="modal" data-bs-target="#addressModal" class="border-0 bg-transparent">
                <i class="fas fa-plus fa-lg m-1 "></i>
            </button>
        </div>

        <hr>

        <div class="row justify-content-between">
            <?php
            $i = 0;
            while ($row = mysqli_fetch_assoc($address_result)) { ?>
                <div class="col-2"><b>
                        <?php echo $row["pickup_shipping_type"]; ?>
                    </b>
                </div>

                <div class="col-7">
                    <p>
                        <?php
                        echo $row["address_line1"] . ' ' . $row["address_line2"] . ' ' . $row["city"] . ' '
                            . $row["state"] . ' ' . $row["country"] . ' ' . $row["postal_code"];
                        ?>

                    </p>
                </div>
                <?php if ($i != 0) { ?>
                    <div class="col-2 d-flex">
                        <a href="delete_address.php?address_id=<?php echo $row['address_id']; ?>" class="delete-address text-dark">
                            <i class="fas fa-trash fa-lg m-2"></i>
                        </a>
                    </div>

                <?php } else {
                    echo '<div class="col-2"> </div>';
                }
                $i = 2;
            } ?>
        </div>

    </div>

    <?php if ($s) { ?>


        <div class="row shadow rounded-3 m-2 p-2 bg-white">
            <div class="d-flex justify-content-between ">
                <h3>Selling Account details</h3>
                <button type="button" class="btn btn-link p-0" data-bs-toggle="modal" data-bs-target="#editModalsell">
                    <i class="fas fa-cog fa-lg m-2 text-dark"></i>
                </button>
            </div>

            <hr class="my-2">

            <div class="col-md-5 col-sm-12  ">

                <div class="row justify-content-between">
                    <strong class="col-6">SellerID</strong>
                    <p class="col-6">
                        <?php echo $sellerdetails["seller_id"] ?>
                    </p>
                </div>
                <div class="row justify-content-between">
                    <strong class="col-6">Verification</strong>
                    <p class="col-6">
                        <?php echo $sellerdetails["verification"] ?>
                    </p>
                </div>

            </div>
            <div class="col-md-5 col-sm-12  ">

                <div class="row justify-content-between">
                    <strong class="col-6">Account No:</strong>
                    <p class="col-6">
                        <?php echo $sellerdetails["bank_account"] ?>
                    </p>
                </div>
                <div class="row justify-content-between">
                    <strong class="col-6">UPI ID:</strong>
                    <p class="col-6">
                        <?php echo $sellerdetails["upi_id"] ?>
                    </p>
                </div>

            </div>

        </div>
    <?php } ?>

</div>

<!-- Add this modal at the end of your HTML body -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit User Details</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Add form elements for editing user details here -->
                <form action="update_user.php" method="POST">
                    <input type="hidden" name="user_id" value="<?php echo $userdetails['user_id']; ?>">

                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username"
                            value="<?php echo $userdetails['username']; ?>">
                        <div class="invalid" id="usernameError"></div>
                    </div>

                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name"
                            value="<?php echo $userdetails['first_name']; ?>">
                        <div class="invalid" id="firstNameError"></div>
                    </div>

                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name"
                            value="<?php echo $userdetails['last_name']; ?>">
                        <div class="invalid" id="lastNameError"></div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="<?php echo $userdetails['email']; ?>">
                        <div class="invalid" id="emailError"></div>
                    </div>

                    <div class="mb-3">
                        <label for="date_of_birth" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                            value="<?php echo $userdetails['date_of_birth']; ?>">
                        <div class="invalid" id="dobError"></div>
                    </div>

                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-select" id="gender" name="gender">
                            <option value="Male" <?php if ($userdetails['gender'] === 'Male')
                                echo 'selected'; ?>>
                                Male</option>
                            <option value="Female" <?php if ($userdetails['gender'] === 'Female')
                                echo 'selected'; ?>>
                                Female</option>
                            <option value="Other" <?php if ($userdetails['gender'] === 'Other')
                                echo 'selected'; ?>>
                                Other</option>
                        </select>
                        <div class="invalid" id="genderError"></div>
                    </div>

                    <div class="mb-3">
                        <label for="phone_number" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number"
                            value="<?php echo $ph['phone_number']; ?>">
                        <div class="invalid" id="phoneNumberError"></div>
                    </div>
                  
                    

                    <div class="mb-3">
                        <label for="secondary_phone_number" class="form-label">Secondary Phone Number</label>
                        <input type="text" class="form-control" id="secondary_phone_number"
                            name="secondary_phone_number" value="<?php echo $ph['phone_number']; ?>">
                        <div class="invalid" id="secondaryPhoneNumberError"></div>
                    </div>

                    <hr>

                    <h4>Change Password</h4>
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Current Password</label>
                        <input type="password" class="form-control" id="current_password" name="current_password">
                        <div class="invalid" id="currentPasswordError"></div>
                    </div>

                    <div class="mb-3">
                        <label for="new_password" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="new_password" name="new_password">
                        <div class="invalid" id="newPasswordError"></div>
                    </div>

                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                        <div class="invalid" id="confirmPasswordError"></div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editModalsell" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Selling Account Details</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="update_selling_account.php" method="POST" id="sellingAccountForm">
                    <!-- Input fields for editing selling account details -->
                    <div class="mb-3">
                        <label for="editBankAccount" class="form-label">Bank Account</label>
                        <input type="text" id="editBankAccount" name="bank_account" class="form-control"
                            value="<?php echo $sellerdetails["bank_account"]; ?>" required>
                        <div class="invalid" id="bankAccountError"></div>
                    </div>
                    <div class="mb-3">
                        <label for="editUpiID" class="form-label">UPI ID</label>
                        <input type="text" id="editUpiID" name="upi_id" class="form-control"
                            value="<?php echo $sellerdetails["upi_id"]; ?>" required>
                        <div class="invalid" id="upiIDError"></div>
                    </div>
                    <!-- ... Add more input fields for other selling account details ... -->
                    <button type="submit" class="btn btn-primary mt-3">Save Changes</button>
                </form>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addressModal" tabindex="-1" role="dialog" aria-labelledby="addressModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addressModalLabel">Add/Edit Address</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Add/Edit Address Form -->
                <form action="addr_add.php" method="POST" id="addressForm">
                    <!-- Address Line 1 -->
                    <div class="mb-3">
                        <label for="address_line1" class="form-label">Address Line 1</label>
                        <input type="text" class="form-control" id="address_line1" name="address_line1" required>
                        <div class="invalid" id="addressLine1Error"></div>
                    </div>
                    <!-- Address Line 2 -->
                    <div class="mb-3">
                        <label for="address_line2" class="form-label">Address Line 2</label>
                        <input type="text" class="form-control" id="address_line2" name="address_line2">
                        <div class="invalid" id="addressLine2Error"></div>
                    </div>
                    <!-- City -->
                    <div class="mb-3">
                        <label for="city" class="form-label">City</label>
                        <input type="text" class="form-control" id="city" name="city" required>
                        <div class="invalid" id="cityError"></div>
                    </div>
                    <!-- State -->
                    <div class="mb-3">
                        <label for="state" class="form-label">State</label>
                        <input type="text" class="form-control" id="state" name="state" required>
                        <div class="invalid" id="stateError"></div>
                    </div>
                    <!-- Country -->
                    <div class="mb-3">
                        <label for="country" class="form-label">Country</label>
                        <input type="text" class="form-control" id="country" name="country" required>
                        <div class="invalid" id="countryError"></div>
                    </div>
                    <!-- Postal Code -->
                    <div class="mb-3">
                        <label for="postal_code" class="form-label">Postal Code</label>
                        <input type="text" class="form-control" id="postal_code" name="postal_code" required>
                        <div class="invalid" id="postalCodeError"></div>
                    </div>
                    <!-- Pickup/Shipping Type -->
                    <div class="mb-3">
                        <label for="pickup_shipping_type" class="form-label">Pickup/Shipping Type</label>
                        <select class="form-select" id="pickup_shipping_type" name="pickup_shipping_type" required>
                            <option value="Pickup">Pickup</option>
                            <option value="Shipping">Shipping</option>
                            <option value="both">Both</option>
                        </select>
                        <div class="invalid" id="pickupShippingTypeError"></div>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Address</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>




<script src="../js/account_det.js"></script>
<script src="../js/addr_val.js"></script>
<script src="../js/sell_up.js">
</script>

<?php include '../includes/footer.php'; ?>

