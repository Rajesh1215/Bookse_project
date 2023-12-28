<?php
$db_host = 'localhost:5000';
$db_user = 'root';
$db_pass = '';
$db_name = 'bookse';

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
