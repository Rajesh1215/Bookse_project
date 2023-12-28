<?php include "../config/database.php"; ?>

<?php
session_start();
$username = $_POST["loginusername"];
$password = $_POST["loginpassword"];
// Prepare and execute the SQL query using a prepared statement
$sql_login = "SELECT user_id,password FROM users WHERE username = ?";
$stmt = mysqli_prepare($conn, $sql_login);
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $dbpass = $row["password"];

        if ($password == $dbpass) {
            $_SESSION["login"] = true;
            $_SESSION["loginerror"] = '';
            $_SESSION["username"] = $username;
            $_SESSION["user_id"]=$row["user_id"];

            header("Location: home.php");
            exit();
        } else {
            $_SESSION["loginerror"] = "Invalid username or password";
            header("Location: home.php"); // Redirect to the login page with an error message
            exit();
        }
    } else {
        $_SESSION["loginerror"] = "Invalid username or password";
        echo "hi";
        header("Location: home.php"); // Redirect to the login page with an error message
        exit();
    }
} else {
    $_SESSION["loginerror"] = "Login failed. Please try again later.";
    header("Location: home.php"); // Redirect to the login page with an error message
    exit();
}




// if ($result) {
//     $row = mysqli_fetch_assoc($result);
//     $dbpass = $row["password"];

//     // Verify the password
//     if ($password== $dbpass) {
//         $_SESSION["login"] = true;
//         $_SESSION["loginerror"]='';
//         echo "bye";
//         // header("Location: home.php");
//         // exit();
//     } else {
//         $_SESSION["login_error"] = "Invalid username or password";
//         header("Location: login.php"); // Redirect to the login page with an error message
//         exit();
//     }
// } else {}
//     $_SESSION["login_error"] = "Login failed. Please try again later.";
//     header("Location: login.php"); // Redirect to the login page with an error message
//     exit();
// }

?>