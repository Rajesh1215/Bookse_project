<?php $act = substr($_SERVER['SCRIPT_NAME'], strpos($_SERVER['SCRIPT_NAME'], "pages/") + 6); ?>

<div class="container-fluid">

    <nav class="navbar navbar-expand-lg navbar-light ">
        <a class="navbar-brand" href="#"><img src="../assets/bookse.png" height="50px" alt="BookSe "></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse px-5 pt-3 justify-content-between" id="navbarNav">


            <ul class="nav nav-underline">
                <li class="nav-item">
                    <a class="nav-link <?= $act == "home.php" ? "active" : ''; ?>" aria-current="page"
                        href="../pages/home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $act == "explore.php" ? "active" : ''; ?>" href="../pages/explore.php"> Explore
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $act == "sellings.php" ? "active" : ''; ?>"
                        href="../pages/sellings.php">Sellings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $act == "orders.php" ? "active" : ''; ?>" href="../pages/orders.php">Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $act == "aboutus.php" ? "active" : ''; ?>" href="../pages/aboutus.php">About us
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../pages/profile.php">
                        <i class="fas fa-user fa-lg mx-2"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../pages/logout.php"> <i class="fas fa-sign-out-alt fa-lg mx-2"></i></a>
                </li>
            </ul>
        </div>
    </nav>

</div>