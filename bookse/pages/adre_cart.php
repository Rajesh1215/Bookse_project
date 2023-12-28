<?php
// Include your database connection code
include "../config/database.php";

// Get the user_id and book_id from the URL parameters
$user_id = $_GET["user_id"];
$book_id = $_GET["book_id"];
$action = $_GET["action"];

if ($action === "add") {
    // Insert into the cart table
    $insertCartQuery = "INSERT INTO cart (user_id, book_id) VALUES ($user_id, $book_id)";
    if (mysqli_query($conn, $insertCartQuery)) {
        echo "Book added to cart!";

    } else {
        echo "An error occurred while adding to cart.";
    }
} elseif ($action === "remove") {
    // Remove from the cart table
    $removeCartQuery = "DELETE FROM cart WHERE user_id = $user_id AND book_id = $book_id";
    if (mysqli_query($conn, $removeCartQuery)) {
        echo "Book removed from cart!";
        
    } else {
        echo "An error occurred while removing from cart.";
    }
}
header("Location: orders.php"); // Corrected header function
        exit();
// Close the database connection
?>
