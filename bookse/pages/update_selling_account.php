<?php
// Include your database connection
include('../config/database.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $seller_id = $_SESSION['user_id'];
    $bank_account = $_POST['bank_account'];
    $upi_id = $_POST['upi_id'];

    // Update seller account information query
    $update_query = "UPDATE sellers SET bank_account='$bank_account', upi_id='$upi_id' WHERE seller_id='$seller_id'";

    if (mysqli_query($conn, $update_query)) {
        // Success
        $_SESSION['update_success'] = true;
        header("Location: profile.php"); // Redirect to selling account page
        exit();
    } else {
        $_SESSION['update_error'] = "Error updating selling account information.";
        header("Location: profile.php"); // Redirect back to selling account page
        exit();
    }
}

// Close the database connection
mysqli_close($connection);
?>
