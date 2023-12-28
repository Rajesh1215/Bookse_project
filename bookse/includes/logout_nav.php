
<?php $act = substr($_SERVER['SCRIPT_NAME'], strpos($_SERVER['SCRIPT_NAME'], "pages/") + 6); ?>

<div class="container-fluid">

    <nav class="navbar navbar-expand-lg navbar-light ">
        <a class="navbar-brand" href="#"><img src="../assets/bookse.png" height="70px" alt="BookSe"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class=" navbar-collapse collapse px-5 pt-3 justify-content-between" id="navbarNav">


            <ul class="nav nav-underline">
                <li class="nav-item">
                    <a class="nav-link <?= $act == "home.php" ? "active" : ''; ?> " aria-current="page"
                        href="../pages/home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $act == "explore.php" ? "active" : ''; ?>" href="../pages/explore.php">
                        Explore
                    </a>
                </li>

                
                <li class="nav-item">
                    <a class="nav-link <?= $act == "aboutus.php" ? "active" : ''; ?>" href="../pages/aboutus.php">About
                        us
                    </a>
                </li>
            </ul>


            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#registerModal">Register</a>
                </li>
            </ul>
        </div>
    </nav>

</div>

<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Log In</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Login Form -->
                    <form method="post" action="../pages/login.php" id="loginForm">
                    <div class="form-group">
                        <label for="loginusername">Username</label>
                        <input type="text" class="form-control" id="loginusername" placeholder="Enter username"
                            name="loginusername" required>
                        <div class="invalid" id="loginusernameError"></div> <!-- Error message container -->
                    </div>
                    <div class="form-group">
                        <label for="loginpassword">Password</label>
                        <input type="password" class="form-control" id="loginpassword" placeholder="Password"
                            name="loginpassword" required >
                        <div class="invalid" id="loginpasswordError"></div> <!-- Error message container -->
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Log In</button>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    
                </div>
            </div>
        
    </div>
</div>

<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerModalLabel">Register</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="registrationForm" method="post" action="../pages/home.php">
                    <!-- First Name -->
                    <div class="mb-3">
                        <label for="firstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstName" name="firstName" required>
                        <div class="invalid" id="firstNameError"></div> <!-- Error message container -->
                    </div>

                    <!-- Last Name -->
                    <div class="mb-3">
                        <label for="lastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastName" name="lastName" required>
                        <div class="invalid" id="lastNameError"></div> <!-- Error message container -->
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                        <div class="invalid" id="emailError"></div> <!-- Error message container -->
                    </div>

                    <!-- Phone Number -->
                    <div class="mb-3">
                        <label for="phoneNumber" class="form-label">Phone Number</label>
                        <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" required>
                        <div class="invalid" id="phoneNumberError"></div> <!-- Error message container -->
                    </div>

                    <!-- Gender -->
                    <div class="mb-3">
                        <label class="form-label">Gender</label>

                        <input class="form-check-input" type="radio" name="gender" id="genderMale" value="male"
                            required>
                        <label class="form-check-label" for="genderMale">Male</label>
                        <input class="form-check-input" type="radio" name="gender" id="genderFemale" value="female"
                            required>
                        <label class="form-check-label" for="genderFemale">Female</label>

                        <div class="invalid" id="genderError"></div> <!-- Error message container -->
                    </div>

                    <!-- Date of Birth -->
                    <div class="mb-3">
                        <label for="dateOfBirth" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" id="dateOfBirth" name="dateOfBirth" max="YYYY-MM-DD"
                            required>
                        <div class="invalid" id="dateOfBirthError"></div> <!-- Error message container -->
                    </div>

                    <!-- Address Line 1 -->
                    <div class="mb-3">
                        <label for="address_line1" class="form-label">Address Line 1</label>
                        <input type="text" class="form-control" id="address_line1" name="address_line1" required>
                        <div class="invalid" id="addressLine1Error"></div> <!-- Error message container -->
                    </div>

                    <!-- Address Line 2 -->
                    <div class="mb-3">
                        <label for="address_line2" class="form-label">Address Line 2</label>
                        <input type="text" class="form-control" id="address_line2" name="address_line2">
                        <div class="invalid" id="addressLine2Error"></div> <!-- Error message container -->
                    </div>

                    <!-- City -->
                    <div class="mb-3">
                        <label for="city" class="form-label">City</label>
                        <input type="text" class="form-control" id="city" name="city" required>
                        <div class="invalid" id="cityError"></div> <!-- Error message container -->
                    </div>

                    <!-- State -->
                    <div class="mb-3">
                        <label for="state" class="form-label">State</label>
                        <input type="text" class="form-control" id="state" name="state" required>
                        <div class="invalid" id="stateError"></div> <!-- Error message container -->
                    </div>

                    <!-- Country -->
                    <div class="mb-3">
                        <label for="country" class="form-label">Country</label>
                        <input type="text" class="form-control" id="country" name="country" required>
                        <div class="invalid" id="countryError"></div> <!-- Error message container -->
                    </div>

                    <!-- Postal Code -->
                    <div class="mb-3">
                        <label for="postal_code" class="form-label">Postal Code</label>
                        <input type="text" class="form-control" id="postal_code" name="postal_code" required>
                        <div class="invalid" id="postalCodeError"></div> <!-- Error message container -->
                    </div>

                    <!-- Pickup / Shipping Type -->
                    <div class="mb-3">
                        <label class="form-label">Pickup / Shipping Type</label>
                        <select class="form-select" id="pickup_shipping_type" name="pickup_shipping_type" required>
                            <option value="Pickup">Pickup</option>
                            <option value="both">Both</option>
                            <option value="Shipping">Shipping</option>
                        </select>
                        <div class="invalid" id="pickupShippingTypeError"></div>
                        <!-- Error message container -->
                    </div>

                    <!-- Username -->
                    <div class="mb-3">
                        <label for="Username" class="form-label">Make Username</label>
                        <input type="text" class="form-control" id="Username" name="Username" required>
                        <div class="invalid" id="usernameError"></div> <!-- Error message container -->
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Create Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                        <div class="invalid" id="passwordError"></div> <!-- Error message container -->
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="conpassword" name="conpassword" required>
                        <div class="invalid" id="conpasswordError"></div> <!-- Error message container -->
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Register</button>
                </form>

            </div>
        </div>
    </div>
</div>



