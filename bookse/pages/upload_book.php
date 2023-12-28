<?php include "../config/database.php"; ?>

<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["stockQty"])) {

    $query = "SELECT MAX(book_id) AS max_book_id FROM books";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $maxBookId = $row["max_book_id"];
        
    } else {
        // Handle error
        echo "Error fetching max book_id: " . mysqli_error($conn);
    }
    $seller_id=$_SESSION["user_id"];
    $nextbookid=$maxBookId+1;
    $title = $_POST["title"];
    $author = $_POST["author"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    $condition = $_POST["condition"];
    $availability = $_POST["availability"];
    $stockQty = $_POST["stockQty"];

    // Insert book details into the books table
    $sql = "INSERT INTO books (book_id,seller_id, title, author, description, price, look_condition, availability, stock_qt)
            VALUES (?,?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "iissssssi",$nextbookid, $seller_id, $title, $author, $description, $price, $condition, $availability, $stockQty);

    if (mysqli_stmt_execute($stmt)) {
        $book_id = $nextbookid; // Get the last inserted book ID

        // Upload and store book images
        $targetDir = "../images_for_db/";
        $uploadedImages = array();

        foreach ($_FILES["bookImages"]["tmp_name"] as $key => $tmp_name) {
            $imageFileName = $_FILES["bookImages"]["name"][$key];
            $imageFileType = pathinfo($imageFileName, PATHINFO_EXTENSION);
            $allowedExtensions = array("jpg", "jpeg", "png");
            if (!in_array($imageFileType, $allowedExtensions)) {
                echo "Only JPG, JPEG, and PNG files are allowed.";
                exit();
            }
            // Generate a unique image ID
            $image_id = uniqid();

            $newImageFileName = "book_$book_id" . "_image_$image_id" . "_$title.$imageFileType";
            $targetFile = $targetDir . basename($newImageFileName);

            if (move_uploaded_file($tmp_name, $targetFile)) {
                $uploadedImages[] = $newImageFileName;

                // Insert image details into the bookimages table
                $sql = "INSERT INTO bookimages (book_id, image_location) VALUES (?, ?)";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "is", $book_id, $newImageFileName);
                mysqli_stmt_execute($stmt);
            }
        }

        mysqli_stmt_close($stmt);
        // Close database connection
        // ...

        echo "Book details and images uploaded successfully!";
    } else {
        echo "Error uploading book details.";
    }
}
$combinedText = $title . ' ' . $author . ' ' . $description; // Combine attributes for keyword extraction
$keywordsArray = explode(' ', $combinedText); // Split text into individual words

$uniqueKeywords = array_unique($keywordsArray); // Remove duplicates
$filteredKeywords = array_filter($uniqueKeywords); // Remove empty entries

// Insert keywords into keywords table if they don't exist
foreach ($filteredKeywords as $keyword) {
    $keyword = mysqli_real_escape_string($conn, $keyword); // Sanitize keyword
    
    // Check if the keyword already exists in the keywords table
    $checkQuery = "SELECT * FROM keywords WHERE keyword = '$keyword'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) == 0) {
        // If keyword doesn't exist, insert it and get the new keyword_id
        $insertQuery = "INSERT INTO keywords (keyword) VALUES ('$keyword')";
        mysqli_query($conn, $insertQuery);
        
        $nextKeywordId = mysqli_insert_id($conn); // Get the auto-generated keyword_id
    } else {
        // If keyword exists, get its keyword_id
        $keywordRow = mysqli_fetch_assoc($checkResult);
        $nextKeywordId = $keywordRow["keyword_id"];
    }

    // Insert book-keyword relationship into bookkeywords table
    $insertBookKeywordQuery = "INSERT INTO bookkeywords (book_id, keyword_id) VALUES ($nextbookid, $nextKeywordId)";
    mysqli_query($conn, $insertBookKeywordQuery);
}


session_write_close();
header("Location: sellings.php"); // Redirect to the home page if not logged in
    
    exit();?>