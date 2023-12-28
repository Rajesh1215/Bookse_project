<?php
include "../config/database.php"; // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["book_id"])) {
    $bookId = $_GET["book_id"];

    // Delete book images from bookimages table
    $deleteImagesQuery = "DELETE FROM bookimages WHERE book_id = ?";
    $stmt = mysqli_prepare($conn, $deleteImagesQuery);
    mysqli_stmt_bind_param($stmt, "i", $bookId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Delete book from books table
    $deleteBookQuery = "DELETE FROM books WHERE book_id = ?";
    $stmt = mysqli_prepare($conn, $deleteBookQuery);
    mysqli_stmt_bind_param($stmt, "i", $bookId);
    if (mysqli_stmt_execute($stmt)) {
        // Redirect back to the book list page
        header("Location: sellings.php"); // Replace with your book list page
        exit();
    } else {
        echo "Error deleting the book.";
    }
    mysqli_stmt_close($stmt);
}
?>
