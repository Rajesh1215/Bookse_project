<?php
// Include your database conn
include('../config/database.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $username = $_POST['username'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $date_of_birth = $_POST['date_of_birth'];
    $gender = $_POST['gender'];
    $phone_number = $_POST['phone_number'];
    $secondary_phone_number = $_POST['secondary_phone_number'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    $current_password = $_POST['current_password'];

    // Retrieve the stored password
    $get_password_query = "SELECT password FROM users WHERE user_id='$user_id'";
    $result = mysqli_query($conn, $get_password_query);
    $row = mysqli_fetch_assoc($result);
    $stored_password = $row['password'];

    // Check if the provided current password matches the stored password
    if (!empty($current_password) && !empty($new_password)) {
        if ($current_password !== $stored_password) {
            $_SESSION['update_error'] = "Current password is incorrect.";
            header("Location: profile.php");
            exit();
        }
    }

    // Update user information query
    $update_query = "UPDATE users SET username='$username', first_name='$first_name', last_name='$last_name', email='$email', 
                     date_of_birth='$date_of_birth', gender='$gender'";

    // Update the password if a new password is provided and current password is correct
    if (!empty($new_password) && $new_password === $confirm_password) {
        $update_query .= ", password='$new_password'";
    }

    $update_query .= " WHERE user_id='$user_id'";

    if (mysqli_query($conn, $update_query)) {
        // Success
        $_SESSION['update_success'] = true;
        header("Location: profile.php"); // Redirect to user's profile
        exit();
    } else {
        // Error handling for duplicate key violation
        if (mysqli_errno($conn) == 1062) { // Error code for duplicate key
            $_SESSION['update_error'] = "Username or Email already exists. Please choose a different one.";
            $_SESSION['update_success'] = false;

        } else {
            $_SESSION['update_error'] = "Error updating user information.";
            $_SESSION['update_success'] = false;

        }
        header("Location: profile.php"); // Redirect back to edit profile page
        exit();
    }
}

// Close the database conn
?>
