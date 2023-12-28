<?php include '../includes/header.php'; ?>
<?php include "../config/database.php"; ?>

<?php
if (isset($_GET["search"])) {
    if (!is_null($_GET["search"])) {


        $seastr = $_GET["search"];


        $keyList = explode(" ", $seastr); // Provide the list of keywords here
        $keywordCount = count($keyList);
        $sea = " AND (
            SELECT COUNT(*) FROM bookkeywords bk
            JOIN keywords k ON bk.keyword_id = k.keyword_id
            WHERE bk.book_id = b.book_id AND k.keyword IN ('" . implode("','", $keyList) . "')
        ) = $keywordCount";

        ?>

        <?php

    } else {
        $sea = "";
        $seastr = "";
    }
} else {
    $sea = "";
    $seastr = "";
}
?>

<div class="container">
    <form class="form-inline my-4  d-flex" action="explore.php" method="get">
        <div class="input-group mb-3 searchbar">
            <input class=" mr-sm-2 searchbar form-control border-0 bg-transparent" id='search' type="search"
                placeholder="Search" aria-label="Search" name="search" value=<?= $seastr ?>>
            <button type="submit" class="border-0 bg-transparent">
                <span class="searchbtn m-2" type="submit">
                    <i class="fas fa-search fa-lg"></i>
                </span>
            </button>
        </div>

    </form>


    <ul class="nav nav-tabs border-0">
        <li class="nav-item ">
            <a class="nav-link active" data-bs-toggle="tab" href="#all">All</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#popular">Popular</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#latest">Latest</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#new">New</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#new-like">New-Like</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#seconds">Seconds</a>
        </li>

    </ul>

    <div class="tab-content mt-4">
        <div class="tab-pane fade show active" id="all">

            <?php

            // Retrieve data from the books table
            $booksQuery = "SELECT b.*, i.image_location FROM books b
JOIN (
    SELECT book_id, MIN(image_id) AS image_id
    FROM bookimages
    GROUP BY book_id
) AS sub ON b.book_id = sub.book_id
JOIN bookimages i ON sub.image_id = i.image_id
WHERE b.stock_qt > 0 $sea;";



            $booksResult = mysqli_query($conn, $booksQuery);

            // Combine and shuffle the results
            $combinedResults = mysqli_fetch_all($booksResult, MYSQLI_ASSOC);
            shuffle($combinedResults);
            ?>

            <div class="row">
                <?php foreach ($combinedResults as $row) { ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card shadow">
                            <img src="../images_for_db/<?php echo $row['image_location']; ?>" class="card-img-top"
                                alt="Book Image" height="200px" width="150px">
                            <div class="card-body">
                                <h7 class="card-title">
                                    <?php echo $row['title']; ?>
                                </h7>

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


        </div>
        <div class="tab-pane fade" id="popular">
            <?php
            // SQL query to retrieve book details with 3 or more orders
            

            // SQL query to retrieve books that contain all the keywords in the key list
            $sql = "SELECT b.book_id, b.title, b.author, b.price, b.look_condition, b.availability,i.image_location
        FROM books AS b
        JOIN (
                SELECT book_id, MIN(image_id) AS image_id
                FROM bookimages
                GROUP BY book_id
            ) AS sub ON b.book_id = sub.book_id
        JOIN orderbooks AS oi ON b.book_id = oi.book_id
        JOIN bookimages i ON sub.image_id = i.image_id
        WHERE b.stock_qt > 0 $sea
        GROUP BY b.book_id
        HAVING COUNT(oi.order_id) >= 2";


            $result = mysqli_query($conn, $sql);

            ?>
            <div class="row">
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <div class="col-md-3 mb-4">
                        <div class="card shadow">
                            <img src="../images_for_db/<?php echo $row['image_location']; ?>" class="card-img-top"
                                alt="Book Image" height="200px" width="150px">
                            <div class="card-body">
                                <h6 class="card-title">
                                    <?php echo $row['title']; ?>
                                </h6>

                                <p class="card-text">Rs.
                                    <?php echo $row['price']; ?>

                                    <a href="productpage.php?book_id=<?php echo $row['book_id']; ?>"
                                        class="btn btn-primary w-100">View</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>

        </div>
        <div class="tab-pane fade" id="latest">
            <?php
            $query = "SELECT b.*, i.image_location FROM books b
            JOIN (
                SELECT book_id, MIN(image_id) AS image_id
                FROM bookimages
                GROUP BY book_id
            ) AS sub ON b.book_id = sub.book_id
            JOIN bookimages i ON sub.image_id = i.image_id
            WHERE b.stock_qt > 0 $sea";

            $result = mysqli_query($conn, $query); ?>

            <div class="row">
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card shadow">
                            <img src="../images_for_db/<?php echo $row['image_location']; ?>" class="card-img-top"
                                alt="Book Image" height="200px" width="150px">
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
        </div>
        <div class="tab-pane fade" id="new">

            <?php
            $query = "SELECT b.*, i.image_location
            FROM books b
            JOIN (
                SELECT book_id, MIN(image_id) AS image_id
                FROM bookimages
                GROUP BY book_id
            ) AS sub ON b.book_id = sub.book_id
            JOIN bookimages i ON sub.image_id = i.image_id
            WHERE b.look_condition = 'New' AND b.stock_qt > 0 $sea";

            $result = mysqli_query($conn, $query); ?>

            <div class="row">
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card shadow">
                            <img src="../images_for_db/<?php echo $row['image_location']; ?>" class="card-img-top"
                                alt="Book Image" height="200px" width="150px">
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
        </div>
        <div class="tab-pane fade" id="new-like">
            <?php
            $query = "SELECT b.*, i.image_location
            FROM books b
            JOIN (
                SELECT book_id, MIN(image_id) AS image_id
                FROM bookimages
                GROUP BY book_id
            ) AS sub ON b.book_id = sub.book_id
            JOIN bookimages i ON sub.image_id = i.image_id
            WHERE b.look_condition = 'Like New' AND b.stock_qt > 0 $sea";

            $result = mysqli_query($conn, $query); ?>

            <div class="row">
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card shadow">
                            <img src="../images_for_db/<?php echo $row['image_location']; ?>" class="card-img-top"
                                alt="Book Image" height="200px" width="150px">
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
        </div>
        <div class="tab-pane fade" id="seconds">
            <?php
            $query = "SELECT b.*, i.image_location
            FROM books b
            JOIN (
                SELECT book_id, MIN(image_id) AS image_id
                FROM bookimages
                GROUP BY book_id
            ) AS sub ON b.book_id = sub.book_id
            JOIN bookimages i ON sub.image_id = i.image_id
            WHERE b.look_condition = 'Used' AND b.stock_qt > 0 $sea";

            $result = mysqli_query($conn, $query); ?>

            <div class="row">
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card shadow">
                            <img src="../images_for_db/<?php echo $row['image_location']; ?>" class="card-img-top"
                                alt="Book Image" height="200px" width="150px">
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
        </div>

    </div>
</div>

<?php include '../includes/footer.php'; ?>