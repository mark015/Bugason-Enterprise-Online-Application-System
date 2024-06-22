<?php
// Include database connection configuration
include('../config.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $productId = $_POST['editProductId'];
    $productName = $_POST['editProductName'];
    $quantity = $_POST['editQuantity'];
    $price = $_POST['editPrice'];
    // $editImage = $_POST['editImage'];


    // File upload handling
    $targetDir = "../uploads/"; // Directory where uploaded files will be stored
    $targetFile = $targetDir . basename($_FILES["editImage"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));


    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["editImage"]["tmp_name"]);
        if($check !== false) {
            // File is an image
            $uploadOk = 1;
        } else {
            // File is not an image
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }


     // Allow certain file formats (optional)




            // File uploaded successfully, proceed with database insertion

            if(!EMPTY($_FILES["editImage"]["name"]) && move_uploaded_file($_FILES["editImage"]["tmp_name"], $targetFile)){
                $sql = "UPDATE products SET 
                products = '$productName', 
                quantity = '$quantity', 
                price = '$price' , img='$targetFile'
                WHERE products_id = '$productId'";
            }else{
                $sql = "UPDATE products SET 
                products = '$productName', 
                quantity = '$quantity', 
                price = '$price'
                WHERE products_id = '$productId'";
            }
    
            if ($conn->query($sql) === TRUE) {
                echo json_encode(array("status" => "success"));
            } else {
                echo json_encode(array("status" => "error", "message" => "Error updating product: " . $conn->error));
            }
        

    
    // Update product details in the database
    // Close database connection
    $conn->close();
} else {
    echo json_encode(array("status" => "error", "message" => "Invalid request method."));
}
?>
