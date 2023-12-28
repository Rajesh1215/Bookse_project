<?php include '../includes/header.php'; ?>
<?php include "../includes/auto_auth.php"; ?>
<?php include "../config/database.php";?>


<div class="container mt-5">
        <div class="row ">
            <!-- Left Section with Image -->
            <div class="col-md-6">


                <div class="shadow rounded-2 orderpage " >
                    <div id="imageCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="image1.jpg" alt="Image 1" class="d-block w-100">
                            </div>
                            <div class="carousel-item">
                                <img src="image2.jpg" alt="Image 2" class="d-block w-100">
                            </div>
                            <!-- Add more carousel items here -->
                        </div>
                        <a class="carousel-control-prev" href="#imageCarousel" role="button" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#imageCarousel" role="button" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-center">
                            <div class="thumbnail">
                                <img src="image1.jpg" alt="Thumbnail 1" class="img-thumbnail"
                                    data-bs-target="#imageCarousel" data-bs-slide-to="0">
                            </div>
                            <div class="thumbnail">
                                <img src="image2.jpg" alt="Thumbnail 2" class="img-thumbnail"
                                    data-bs-target="#imageCarousel" data-bs-slide-to="1">
                            </div>
                            <!-- Add more thumbnails for each carousel item -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Section with Carousel and Product Details -->

            <div class="col-md-6">
                <div class="row h-100 ">
                    <div class="col-12 ">
                        <h2>Product Details</h2>
                        <p>Book ID: 12345</p>
                        <p>Title: Product Title</p>
                        <p>Description: Lorem ipsum dolor sit amet...</p>

                        
                    </div>
                    <div class="col-12 ">
                        <h2>Transaction Details</h2>
                        <p>sold for:123</p>
                        <p>payment:done</p>
                        <p>TransactionID:1234</p>
                        <p>Buyerid:1234</p>
                        <p>orderid:1234</p>


                    </div>
                </div>
            </div>
        </div>

        <!-- Thumbnail List -->

    </div>


<?php include '../includes/footer.php'; ?>

<div class="container text-center mt-4">
    <p>Kammaluri Rajesh (ID: R190812) | Vinay Gowdu (ID: R190785)</p>
</div>
