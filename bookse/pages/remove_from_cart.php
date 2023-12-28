<?php
include "../config/database.php"; // Include your database connection

if (isset($_GET['book_id'])) {
    $book_id = $_GET['book_id'];

    // Delete the item from the cart
    $delete_query = "DELETE FROM cart WHERE book_id = ?";
    $stmt = mysqli_prepare($conn, $delete_query);
    mysqli_stmt_bind_param($stmt, "i", $book_id);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        header("Location: orders.php"); // Redirect back to the selling page after removing the item
        exit();
    } else {
        echo "Error removing item from cart: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}
?>
