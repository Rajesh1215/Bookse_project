<?php
// Include your database connection
include('../config/database.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['address_id'])) {
    $address_id = $_GET['address_id'];

    // Delete address query
    $delete_query = "DELETE FROM addresses WHERE address_id = '$address_id'";

    if (mysqli_query($conn, $delete_query)) {
        $_SESSION['delete_success'] = true;
        $_SESSION['delete_message'] = "Address deleted successfully.";
    } else {
        $_SESSION['delete_error'] = "Error deleting address.";
    }
}

// Close the database connection

// Redirect back to the page where the delete was initiated
header("Location: profile.php"); // Replace with the appropriate URL
exit();
?>
