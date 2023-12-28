<?php
// Include your database connection
include('../config/database.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bank_account = mysqli_real_escape_string($conn, $_POST['accountNo']);
    $upi = mysqli_real_escape_string($conn, $_POST['upiId']);
    $user_id = $_SESSION['user_id'];

    // Update seller account information query
    $sql = "INSERT INTO sellers (seller_id, user_id, bank_account, upi_id) VALUES ('$user_id', '$user_id', '$bank_account', '$upi')";
    if (mysqli_query($conn, $sql)) {
        // Success
        $_SESSION['update_success'] = true;
        header("Location: sellings.php"); // Redirect to selling account page
        exit();
    } else {
        $_SESSION['update_error'] = "Error updating selling account information.";
        header("Location: sellings.php"); // Redirect back to selling account page
        exit();
    }
}

// Close the database connection
mysqli_close($conn);
?>
