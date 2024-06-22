<?php
// Include database connection configuration
include('../config.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $productName = $_POST['productName'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    // File upload handling
    $targetDir = "../uploads/"; // Directory where uploaded files will be stored
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check !== false) {
            // File is an image
            $uploadOk = 1;
        } else {
            // File is not an image
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check if file already exists

    // Check file size (optional)
    
    // Allow certain file formats (optional)
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            // File uploaded successfully, proceed with database insertion
            // Perform SQL query to insert data into database
            $sql = "INSERT INTO products (cat_id, products, quantity, price, img) VALUES ('$category','$productName', '$quantity', '$price', '$targetFile')";
            
            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    // Close database connection
    $conn->close();
}
?>
