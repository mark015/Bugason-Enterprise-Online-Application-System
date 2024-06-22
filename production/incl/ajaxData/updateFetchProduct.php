<?php
// Include database connection configuration
include('../config.php');

// Check if product ID is provided
if (isset($_GET['productId'])) {
    // Get product ID from the request
    $productId = $_GET['productId'];
    // Fetch product details from the database
    $sql = "SELECT * FROM products WHERE products_id = '$productId'";
    $result = $conn->query($sql);

    // Check if product is found
    if ($result->num_rows > 0) {
        // Fetch product data
        $product = $result->fetch_assoc();

        // Return product data as JSON response
        echo json_encode($product);
    } else {
        // Product not found
        echo json_encode(array("status" => "error", "message" => "Product not found."));
    }
} else {
    // Product ID not provided
    echo json_encode(array("status" => "error", "message" => "Product ID not provided."));
}

// Close database connection
$conn->close();
?>
