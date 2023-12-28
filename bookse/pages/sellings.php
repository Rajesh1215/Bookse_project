<?php include "../includes/auto_auth.php"; ?>

<?php include '../includes/header.php'; ?>

<?php include "../config/database.php"; ?>



<?php
$user_idsell = $_SESSION['user_id'];

$sellerid_sql = "SELECT seller_id FROM sellers WHERE user_id=$user_idsell";
$sellerid_sql_result = mysqli_query($conn, $sellerid_sql);

if (mysqli_num_rows($sellerid_sql_result) > 0) {

    $sellid_row = mysqli_fetch_assoc($sellerid_sql_result);
    $seller_id = $sellid_row['seller_id'];

    $query = "SELECT b.*, MIN(i.image_location) AS image_location
          FROM books b
          JOIN bookimages i ON b.book_id = i.book_id
          WHERE b.seller_id = $seller_id
          GROUP BY b.book_id";



    $result = mysqli_query($conn, $query);

    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="list-group mb-2 list-group-horizontal ">
                    <ul class="list-group-item w-100 shadow rounded-3">
                        <?php
                        // Retrieve seller information from the database
                        $sellerId = $seller_id; // Replace with your actual seller ID
                        $querySeller = "SELECT * FROM sellers WHERE seller_id = $sellerId";
                        $resultSeller = mysqli_query($conn, $querySeller);

                        if ($resultSeller && mysqli_num_rows($resultSeller) > 0) {
                            $sellerData = mysqli_fetch_assoc($resultSeller);
                            ?>
                            <li class="list-group-item"><strong>Seller ID:</strong>
                                <?php echo $sellerData['seller_id']; ?>
                            </li>
                            <li class="list-group-item"><strong>Account No:</strong>
                                <?php echo $sellerData['bank_account']; ?>
                            </li>
                            <li class="list-group-item"><strong>UPI ID:</strong>
                                <?php echo $sellerData['upi_id']; ?>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 ">
                <ul class="list-group shadow rounded-3">
                    <?php
                    // Retrieve seller statistics from the database
                    $queryStats = "SELECT SUM(total_amount) AS total_earned,
                        COUNT(total_amount ) AS total_sales

                FROM orders o
                JOIN orderbooks ob ON o.order_id = ob.order_id
                JOIN books b ON ob.book_id = b.book_id
                JOIN (select min(image_id),image_location,book_id from bookimages group by book_id) i ON b.book_id = i.book_id
                WHERE o.seller_id = $seller_id";

                $query2="select sum(stock_qt) as total_items_on_store from books where seller_id = $user_idsell and stock_qt > 0";
                        $query2res= mysqli_query($conn, $query2);
                    $resultStats = mysqli_query($conn, $queryStats);


                    if ($resultStats && mysqli_num_rows($resultStats) > 0) {
                        $statsData = mysqli_fetch_assoc($resultStats);
                        $stat=mysqli_fetch_assoc($query2res);
                        ?>
                        <li class="list-group-item"><strong>Total Money Earned:</strong> Rs.
                            <?php echo $statsData['total_earned']; ?>
                        </li>
                        <li class="list-group-item"><strong>Total Number of Sales:</strong>
                            <?php echo $statsData['total_sales']; ?>
                        </li>
                        
                        <li class="list-group-item"><strong>Number of Items on Store:</strong>
                            <?php echo $stat['total_items_on_store']; ?>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>



            <div class="col-md-9">
                <ul class="nav nav-tabs mt-4">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#store">Store</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#sales">Sales</a>
                    </li>
                </ul>

                <div class="tab-content mt-4">

                    <div class="tab-pane fade show active" id="store">
                        <button class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#addnewModal">
                            Add new item
                        </button>
                        <div class="container m-2">
                            <?php if (mysqli_num_rows($result) > 0) { ?>
                                <div class="row ">
                                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                        <div class="card my-1 border-3 ">
                                            <div class="d-flex align-items-center">
                                                <img src="../images_for_db/<?php echo $row['image_location']; ?>"
                                                    class="card-img-left" alt="Book Image"  height="100px">
                                                <div class="card-body">
                                                    <h5 class="card-title">
                                                        <?php echo $row['title']; ?>
                                                    </h5>
                                                    <p class="card-text">Price: Rs.
                                                        <?php echo $row['price']; ?>
                                                    </p>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <a href="delete_book.php?book_id=<?php echo $row['book_id']; ?>"
                                                        class="btn btn-danger btn-sm">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php } else { ?>
                                <p>You haven't added any item.</p>
                            <?php } ?>
                        </div>



                    </div>
                    <div class="tab-pane fade" id="sales">
                        <?php

                        $query = "SELECT o.order_id, b.book_id, b.title, b.author, b.price, i.image_location,u.username
                        FROM orders o
                        JOIN orderbooks ob ON o.order_id = ob.order_id
                        JOIN books b ON ob.book_id = b.book_id
                        Join users u on u.user_id=o.user_id
                        JOIN (select min(image_id),image_location,book_id from bookimages group by book_id) i ON b.book_id = i.book_id
                        WHERE o.seller_id = $seller_id;
                        "; // Assuming seller_id 2
                        $result = mysqli_query($conn, $query);
                        


                        ?>

                        <div class="row">
                            <?php
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <div class="card m-2 border-3">
                                        <div class="d-flex align-items-center">
                                            <img src="../images_for_db/<?php echo $row['image_location']; ?>"
                                                class="card-img-top w-25" alt="Book Image" height="100px">
                                            <div class="card-body">
                                                <h5 class="card-title">Title:
                                                    <?php echo $row['title']; ?>
                                                </h5>
                                                <p class="card-text">Author:
                                                    <?php echo $row['author']; ?>
                                                </p>
                                                <p class="card-text">Price: Rs.
                                                    <?php echo $row['price']; ?>
                                                </p>
                                                <p class="card-text">order_id:
                                                    <?php echo $row['order_id']; ?>
                                                </p>
                                                <p class="card-text">Sold for:
                                                    <?php echo $row['username']; ?>
                                                </p>

                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            } else {
                                echo '<p>You haven\'t sold any item.</p>';
                            }
                            ?>
                        </div>



                    </div>
                </div>

            </div>


        </div>

    </div>




    <!-- Add Item Modal -->
    <div class="modal fade" id="addnewModal" tabindex="-1" role="dialog" aria-labelledby="addItemModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addItemModalLabel">Add Item to Store</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container mt-5">
                        <h2>Add Book Details</h2>
                        <form action="upload_book.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    placeholder="Enter book title" required>
                            </div>
                            <div class="form-group">
                                <label for="author">Author</label>
                                <input type="text" class="form-control" id="author" name="author"
                                    placeholder="Enter author's name">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3"
                                    placeholder="Enter book description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" class="form-control" id="price" name="price"
                                    placeholder="Enter book price" required>
                            </div>
                            <div class="form-group">
                                <label for="condition">Condition</label>
                                <select class="form-control" id="condition" name="condition" required>
                                    <option value="New">New</option>
                                    <option value="Used">Used</option>
                                    <option value="Like New">Like New</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="availability">Availability</label>
                                <input type="text" class="form-control" id="availability" name="availability"
                                    placeholder="Enter availability status">
                            </div>
                            <div class="form-group">
                                <label for="stockQty">Stock Quantity</label>
                                <input type="number" class="form-control" id="stockQty" name="stockQty"
                                    placeholder="Enter stock quantity">
                            </div>
                            <div class="form-group">
                                <label for="bookImages">Book Images</label>
                                <input type="file" class="form-control-file" id="bookImages" name="bookImages[]" multiple
                                    required>
                                <small class="form-text text-muted">You can upload multiple images.</small>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Book</button>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


<?php } else { ?>
    <?php include 'cre_seller.php'; ?>


    <?php
} ?>
<script src="../js/sell_up.js"></script>


<?php include '../includes/footer.php'; ?>

