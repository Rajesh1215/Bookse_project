<?php include "../includes/auto_auth.php"; ?>

<?php include '../includes/header.php'; ?>
<?php include "../config/database.php"; ?>

<?php
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Query to retrieve orders data for the logged-in user
    $query_orders = "SELECT b.*, o.*, i.image_location,s.username FROM orders o
                    JOIN orderbooks ob ON o.order_id = ob.order_id
                    join users s on s.user_id=o.seller_id
                    JOIN books b ON ob.book_id = b.book_id
                    JOIN (
                        SELECT book_id, MIN(image_id) AS image_id
                        FROM bookimages
                        GROUP BY book_id
                    ) AS sub ON b.book_id = sub.book_id
                    JOIN bookimages i ON sub.image_id = i.image_id
                    WHERE o.user_id = $user_id"; // Assuming user_id is buyer's user_id

    $result_orders = mysqli_query($conn, $query_orders);

    // Now you can loop through $result_orders to display the orders

}

// Query to retrieve cart data
$query_cart = "SELECT b.*, i.image_location FROM cart c
               JOIN books b ON c.book_id = b.book_id
               JOIN (
                   SELECT book_id, MIN(image_id) AS image_id
                   FROM bookimages
                   GROUP BY book_id
               ) AS sub ON b.book_id = sub.book_id
               JOIN bookimages i ON sub.image_id = i.image_id
               WHERE c.user_id = $user_id"; // Assuming user_id

$result_cart = mysqli_query($conn, $query_cart);
?>

<div class="container">
    <div class="row">
        <div class="col-7">
            <h3>Orders</h3>
            <?php while ($row = mysqli_fetch_assoc($result_orders)) { ?>
                <div class="card mx-2 my-1 rounded shadow">
                    <div class="d-flex align-items-center">
                        <img src="../images_for_db/<?php echo $row['image_location']; ?>" class="card-img-top w-25"
                            alt="Book Image">
                        <div class="card-body d-flex justify-content-between mx-2">
                            <div>
                                <h5 class="card-title">
                                    <?php echo $row['title']; ?>
                                </h5>
                                <p class="card-text">Ordered Date:
                                    <?php
                                    $dateTimeString = $row['order_date'];
                                    $dateTime = new DateTime($dateTimeString);
                                    echo $dateTime->format('Y-m-d'); // Format the date as 'YYYY-MM-DD'
                                    ?>
                                </p>

                                <p class="card-text"> price:
                                    <?php echo $row['total_amount']; ?>
                                </p>
                                <p class="card-text"> Bought from:
                                    <?php echo $row['username']; ?>
                                </p>


                            </div>
                            <div>
                                <p class="card-text ">Status:
                                    <b class="text-danger">
                                        <?php echo $row['payment_status']; ?>
                                    </b>
                                </p>
                                <p class="card-text">Arrival Date:
                                    <?php echo "not fixed"; ?>
                                </p>
                            </div>
                        </div>
                    </div><!-- Display order details here -->
                </div>
            <?php } ?>
        </div>
        <div class="col-5 rounded-2 p-2">
            <h3>Cart</h3>
            <?php
            if (mysqli_num_rows($result_cart) > 0) {
                while ($row = mysqli_fetch_assoc($result_cart)) {
                    ?>
                    <div class="card mb-2">
                        <div class="d-flex align-items-center">
                            <img src="../images_for_db/<?php echo $row['image_location']; ?>" class="card-img-top w-25"
                                alt="Book Image">
                            <div class="card-body d-flex justify-content-between mx-2">
                                <div>
                                    <h5 class="card-title">
                                        <?php echo $row['title']; ?>
                                    </h5>

                                </div>
                                <div>
                                    <!-- Add functionality to remove item from cart here -->
                                    <a href="productpage.php?book_id=<?php echo $row['book_id']; ?>"
                                        class="btn btn-primary btn-sm">View</a>
                                    <a href="remove_from_cart.php?book_id=<?php echo $row['book_id']; ?>"
                                        class="btn btn-danger btn-sm">Remove</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "No items in the cart.";
            }
            ?>
        </div>

    </div>
</div>

<?php include '../includes/footer.php'; ?>

