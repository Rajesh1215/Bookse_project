<?php include "../config/database.php"; ?>


<?php

session_start();


function displayFloatingAlert($message, $type = 'success')
{
    echo '<div class="alert alert-' . $type . ' alert-dismissible fade show  m-3" role="alert">
            ' . $message . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
}

// Check if login error message exists in the session
if (isset($_SESSION['loginerror']) && !empty($_SESSION['loginerror'])) {
    displayFloatingAlert($_SESSION['loginerror'], 'danger');
    // Clear the login error message from the session
    $_SESSION['loginerror'] = "";
}



if (isset($_POST["Username"])) {

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];
    $dateOfBirth = $_POST['dateOfBirth'];
    $phoneNumber = $_POST['phoneNumber'];
    $username = $_POST["Username"];
    $addressLine1 = $_POST['address_line1'];
    $addressLine2 = $_POST['address_line2'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $postalCode = $_POST['postal_code'];
    $pickupShippingType = $_POST['pickup_shipping_type'];


    $sql = "SELECT MAX(user_id) AS max_user_id FROM users";
    $resultuserid = $conn->query($sql);
    $row = $resultuserid->fetch_assoc();
    $maxUserID = $row['max_user_id'];

    $addrsql = "SELECT MAX(address_id) AS max_user_id FROM addresses";
    $res_add = $conn->query($addrsql);
    $adrow = $res_add->fetch_assoc();
    $preaddr = $adrow['max_user_id'];

    $phosql = "SELECT MAX(phone_id) AS max_user_id FROM phonenumbers";
    $res_pho = $conn->query($phosql);
    $phrow = $res_pho->fetch_assoc();
    $ph_id = $phrow['max_user_id'];

    $nextphid = $ph_id + 1;

    $nexaddr = $preaddr + 1;
    // Calculate the next available user_id
    $nextUserID = $maxUserID + 1;
    // Insert data into users table
    try {
        $regissql = "INSERT INTO users (user_id, username, first_name, last_name, email, password, gender, date_of_birth) 
            VALUES ('$nextUserID','$username', '$firstName', '$lastName', '$email', '$password', '$gender', '$dateOfBirth')";
        $register_res = mysqli_query($conn, $regissql);

        if (!$register_res) {
            throw new Exception(mysqli_error($conn));
        }

        $phone_sql = "INSERT INTO phonenumbers (phone_id, user_id, phone_number) VALUES ('$nextphid', $nextUserID, '$phoneNumber')";
        $res_phone = mysqli_query($conn, $phone_sql);

        if (!$res_phone) {
            throw new Exception(mysqli_error($conn));
        }

        $addr_sql = "INSERT INTO addresses (address_id, user_id, address_line1, address_line2, city, state, country, postal_code, pickup_shipping_type) 
            VALUES ($nexaddr, $nextUserID, '$addressLine1', '$addressLine2', '$city', '$state', '$country', '$postalCode', '$pickupShippingType')";
        $res_address = mysqli_query($conn, $addr_sql);

        if (!$res_address) {
            throw new Exception(mysqli_error($conn));
        }

        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Registration successful! Data has been inserted into the database.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        if ($register_res && $res_phone && $res_address) {
            $_SESSION["username"] = $_POST["Username"];
            $_SESSION["user_id"] = $nextUserID;
            $_SESSION["login"] = true;
        }
    } catch (Exception $e) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Registration failed. Something went wrong. Error: ' . $e->getMessage() . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }


}
session_write_close();
?>

<?php include '../includes/header.php'; ?>



<div class="container color">
    <div class=" m-2  d-flex flex-column align-items-center">
        <h1 class=" my-4">Exploring Worlds, One Page at a Time</h1>

        <form class="form-inline my-4  d-flex" action="explore.php" method="get">
            <div class="input-group mb-3 searchbar">
                <input class=" mr-sm-2 searchbar form-control border-0 bg-transparent" type="search"
                    placeholder="Search" aria-label="Search" name="search">
                <button type="submit" class="border-0 bg-transparent">
                    <span class="searchbtn m-2" type="submit">
                        <i class="fas fa-search fa-lg"></i>
                    </span>
                </button>
            </div>

        </form>
        <p class="description">Bookse is a dynamic online marketplace where book enthusiasts can
            seamlessly buy and sell a diverse array of books, ranging from cherished classics to
            contemporary gems, fostering a vibrant community that celebrates the joy of reading
            and the exchange of knowledge and stories.

        </p>
    </div>



    <div class="hom ">

        <h4 class="m-3">Popular</h4>

        <?php


        // SQL query to retrieve book details with 3 or more orders
        $sql = "SELECT b.book_id, b.title, b.author, b.price, b.look_condition, b.availability,i.image_location
        FROM books AS b
        JOIN (
                SELECT book_id, MIN(image_id) AS image_id
                FROM bookimages
                GROUP BY book_id
            ) AS sub ON b.book_id = sub.book_id
        JOIN orderbooks AS oi ON b.book_id = oi.book_id
        JOIN bookimages i ON sub.image_id = i.image_id
        WHERE b.stock_qt 
        GROUP BY b.book_id
        HAVING COUNT(oi.order_id) >= 2";
        $result = mysqli_query($conn, $sql);

        ?>
        <div class="container">
            <div class="row">
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <div class="col-md-3 mb-4">
                        <div class="card shadow">
                            <img src="../images_for_db/<?php echo $row['image_location']; ?>" class="card-img-top"
                                alt="Book Image" height="200px" width="1500px">
                            <div class="card-body">
                                <h6 class="card-title">
                                    <?php echo $row['title']; ?>
                                </h6>

                                <p class="card-text">Rs.
                                    <?php echo $row['price']; ?>
                                </p>


                                <a href="productpage.php?book_id=<?php echo $row['book_id']; ?>"
                                    class="btn btn-primary w-100">View</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>



            <h4 class="m-3">New</h4>
            <?php

            $query = "SELECT b.*, i.image_location FROM books b
        JOIN (
             SELECT book_id, MIN(image_id) AS image_id
         FROM bookimages
         GROUP BY book_id
        ) AS sub ON b.book_id = sub.book_id
        JOIN bookimages i ON sub.image_id = i.image_id
        WHERE b.stock_qt > 0
        LIMIT 4";
            $result = mysqli_query($conn, $query);

            ?>

            <div class="row">
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card shadow">
                            <img src="../images_for_db/<?php echo $row['image_location']; ?>" class="card-img-top"
                                alt="Book Image" height="200px" width="1500px">
                            <div class="card-body">
                                <h6 class="card-title">
                                    <?php echo $row['title']; ?>
                                </h6>
                                <p class="card-text"> Rs.
                                    <?php echo $row['price']; ?>
                                </p>
                                <a href="productpage.php?book_id=<?php echo $row['book_id']; ?>"
                                    class="btn btn-primary w-100">View</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>



            <div class="text-center p-3">
                <a href="explore.php" class="btn btn-primary ">Go to Explore</a>
            </div>
        </div>
    </div>
</div>


<?php include '../includes/footer.php'; ?>