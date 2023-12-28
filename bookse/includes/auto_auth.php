<?php
    session_start(); // Start the session if it hasn't been started yet



if (!isset($_SESSION['username'])) {
    session_write_close();
    header("Location: home.php"); // Redirect to the home page if not logged in
    
    exit();
}
?>
