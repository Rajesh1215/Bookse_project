<?php
// Include your database connection
include('../config/database.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user_id from the session
    $user_id = $_SESSION['user_id'];

    // Retrieve form data
    $address_line1 = $_POST['address_line1'];
    $address_line2 = $_POST['address_line2'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $postal_code = $_POST['postal_code'];
    $pickup_shipping_type = $_POST['pickup_shipping_type'];

    // Insert address into addresses table
    $insert_query = "INSERT INTO addresses (user_id, address_line1, address_line2, city, state, country, postal_code, pickup_shipping_type)
                     VALUES ('$user_id', '$address_line1', '$address_line2', '$city', '$state', '$country', '$postal_code', '$pickup_shipping_type')";

    if (mysqli_query($conn, $insert_query)) {
        // Address insertion successful
        $_SESSION['address_insert_success'] = true;
        header("Location: profile.php"); // Redirect to user's profile
        exit();
    } else {
        // Error inserting address
        $_SESSION['update_error'] = "Error inserting address.";
        header("Location: profile.php"); // Redirect back to profile page
        exit();
    }
}

// Close the database connection
mysqli_close($conn);
?>
