<!-- header.php -->

<!DOCTYPE html>
<html  lang="en">
<head>
    <title>BOOKSE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Link to your custom styles -->
    <!-- Link to Bootstrap CSS -->
     <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


</head>
<body class="backgd h-100">

    <?php
    // Check if the user is logged in

  // You would replace this with your actual login check logic
  if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Start the session if it hasn't been started yet
}
    if (isset($_SESSION["login"]) && $_SESSION["login"]) {
        // Display navigation bar for logged-in users
        include 'login_nav.php';
    } else {
        // Display navigation bar for non-logged-in users
        include 'logout_nav.php';
    }
    ?>
    <!-- Rest of the page content -->
