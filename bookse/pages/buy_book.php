<?php
// Include your database connection code
include "../config/database.php";

// Assuming you have received the necessary form data
$user_id = $_POST["buyer_id"];
$seller_id = $_POST["seller_id"];
$total_amount = $_POST["total_amount"];
$shippaddr = $_POST["shippaddr"];
$book_id = $_POST["book_id"];
$quantity = $_POST["quantity"];

// Get the highest existing order_id
$getMaxOrderIdQuery = "SELECT MAX(order_id) AS max_order_id FROM orders";
$result = mysqli_query($conn, $getMaxOrderIdQuery);
$row = mysqli_fetch_assoc($result);
$max_order_id = $row["max_order_id"];

// Increment the highest order_id
$new_order_id = $max_order_id + 1;

// Insert order into orders table with the new order_id
$insertOrderQuery = "INSERT INTO orders (order_id, user_id, seller_id, total_amount, shippaddr, payment_status)
                     VALUES ($new_order_id, $user_id, $seller_id, $total_amount, '$shippaddr', 'Pending')";
mysqli_query($conn, $insertOrderQuery);

// Insert order details into orderbooks table
$insertOrderBookQuery = "INSERT INTO orderbooks (order_id, book_id, quantity)
                         VALUES ($new_order_id, $book_id, $quantity)";
mysqli_query($conn, $insertOrderBookQuery);

// Update stock in books table
$updateStockQuery = "UPDATE books SET stock_qt = stock_qt - $quantity WHERE book_id = $book_id";
mysqli_query($conn, $updateStockQuery);

// Check if stock has become 0 and delete the record if needed
$checkStockQuery = "SELECT stock_qt FROM books WHERE book_id = $book_id";
$result = mysqli_query($conn, $checkStockQuery);
$row = mysqli_fetch_assoc($result);
echo $row["stock_qt"];



header("Location: orders.php");
exit();
?>
