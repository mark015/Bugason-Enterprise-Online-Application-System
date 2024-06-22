<?php
// Include database configuration
include('../incl/config.php');

// Check if the search query and category are received
if(isset($_POST['productId'])){
    $productId = $_POST['productId'];

    // SQL query to fetch filtered product data based on search query and category
    $sql = "SELECT `quantity` FROM `products` where products_id='$productId'";
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

    // Return product data as JSON
    header('Content-Type: application/json');
} else {
    // If search query or category is not received
    echo "No search query or category received.";
}

// Close connection
$conn->close();
?>
