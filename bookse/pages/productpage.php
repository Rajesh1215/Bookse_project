<?php include '../includes/header.php'; ?>
<?php include "../config/database.php"; ?>

<?php
$book_id = $_GET["book_id"];

$query = "SELECT * FROM bookimages WHERE book_id = $book_id";
$result = mysqli_query($conn, $query);
$firstImage = true;
?>

<div class="container mt-5">

    <div class="row">
        <!-- Left Section with Image -->

        <div class="col-md-4">

            <div class="shadow rounded-2 orderpage">
                <div id="imageCarousel" class="carousel slide  h-100 w-100" data-bs-ride="carousel"
                    data-bs-interval="3000">
                    <div class="carousel-inner h-100 w-100 ">
                        <?php
                        $thumbnailIndex = 0; // Counter for generating data-bs-slide-to index for thumbnails
                        
                        while ($row = mysqli_fetch_assoc($result)) {
                            $imagePath = $row['image_location'];
                            $isActiveClass = $firstImage ? 'active' : '';
                            ?>

                            <div class="carousel-item h-100 w-100  <?= $isActiveClass ?>"
                                style="background-color:black">
                                <img src="../images_for_db/<?= $imagePath ?>" alt="Book Image" class="d-block h-100 w-100 p-2">
                            </div>

                            <?php
                            $firstImage = false;
                            $thumbnailIndex++;
                        }
                        ?>
                    </div>
                    <!-- Controls -->
                    <a class="carousel-control-prev" href="#imageCarousel" role="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#imageCarousel" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </a>
                </div>
                <!-- Thumbnail List -->

            </div>



        </div>

        <!-- Right Section with Carousel and Product Details -->
        <div class="col-md-4">
            <div class="row h-100">
                <div class="col-12">
                    <h2>Product Details</h2>
                    <?php
                    $query = "SELECT * FROM books WHERE book_id = $book_id";
                    $result = mysqli_query($conn, $query);
                    $row = mysqli_fetch_assoc($result);
                    ?>
                    <p>Book ID:
                        <?= $row['book_id'] ?>
                    </p>
                    <p>Title:
                        <?= $row['title'] ?>
                    </p>
                    
                    <p>stock:
                        <?php
                        if (is_null($row['stock_qt'])) {

                        } else {
                            echo $row['stock_qt'];

                        }
                        ?>
                    </p>
                    <p>Description:
                        <?= $row['price'] ?>
                    </p>
                    <!-- Add more details as needed -->
                </div>
                <div class="col-12">
                    
                    <?php
                    // Assuming $user_id and $book_id are already defined
                    $isInCart = false; // Initialize to false
                    
                    
                    // Check if the item is in the cart
                    if(isset($_SESSION["login"]) && $_SESSION["login"]){

                    $user_id=$_SESSION["user_id"];
                    $book_id= $row['book_id'];
                    $checkCartQuery = "SELECT * FROM cart WHERE user_id = $user_id AND book_id = $book_id";
                    $cartResult = mysqli_query($conn, $checkCartQuery);
                    if (mysqli_num_rows($cartResult) > 0) {
                        $isInCart = true;
                    }

                    ?>
                    <button class="btn btn-primary buy-btn" data-bs-toggle="modal"
                        data-bs-target="#buyModal">Buy</button>

                    <a href="adre_cart.php?user_id=<?= $user_id ?>&book_id=<?= $book_id ?>&action=<?= $isInCart ? 'remove' : 'add' ?>"
                        class="btn btn-warning">
                        <?= $isInCart ? 'Remove from Cart' : 'Add to Cart' ?>
                    </a>
                    <?php } else{?>
                        <button class="btn btn-primary buy-btn" data-bs-toggle="modal"
                        data-bs-target="#loginModal">Buy</button>
                        <?php } ?>
                </div>
            </div>
        </div>
        <div class="col-4">
        <p><b>Description:</b> <br>
                        <?=$row['description'] ?>
                    </p>

        </div>
    </div>
</div>


<?php if(isset($_SESSION["login"]) && $_SESSION["login"]){ ?>
<div class="modal fade" id="buyModal" tabindex="-1" aria-labelledby="buyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="buyModalLabel">Buy Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="buy_book.php" method="post">
                    <input type="hidden" name="book_id" id="book_id_input" value=<?= $row['book_id'] ?>>
                    <input type="hidden" name="buyer_id" id="book_id_input" value=<?php echo $_SESSION["user_id"]; ?>>
                    <input type="hidden" name="seller_id" id="book_id_input" value=<?= $row['seller_id'] ?>>
                    <input type="hidden" name="total_amount" id="book_id_input" value=<?= $row['price'] ?>>

                    <label for="quantityInput" class="form-label">Quantity:</label>
                    <?php
                    $maxQuantity = is_null($row['stock_qt']) ? 10 : min($row['stock_qt'], 10);
                    ?>
                    <select class="form-select" id="quantityInput" name="quantity">
                        <?php
                        for ($i = 1; $i <= $maxQuantity; $i++) {
                            echo '<option value="' . $i . '">' . $i . '</option>';
                        }
                        ?>
                    </select>

                    <label for="addressSelect" class="form-label mt-3">Select Address:</label>

                    <select class="form-select" id="addressSelect" name="shippaddr">
                        <?php
                        $buyer_id = $_SESSION["user_id"];
                        $address_query = "SELECT * FROM addresses WHERE user_id = $buyer_id"; // Replace with actual user ID
                        $address_result = mysqli_query($conn, $address_query);

                        while ($address_row = mysqli_fetch_assoc($address_result)) {
                            $address_id = $address_row['address_id'];
                            $address_line1 = $address_row['address_line1'];
                            $address_line2 = $address_row['address_line2'];
                            $city = $address_row['city'];
                            $state = $address_row['state'];
                            $country = $address_row['country'];
                            $postal_code = $address_row['postal_code'];
                            $full_address = "$address_line1 $address_line2 $city $state $country $postal_code";
                            echo "<option value='$address_id'>$full_address</option>";
                        }
                        ?>
                    </select>

                    <button type="submit" class="btn btn-primary">Buy Now</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<?php include '../includes/footer.php'; ?>

