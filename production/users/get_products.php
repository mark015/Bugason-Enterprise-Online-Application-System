<?php
// Include database configuration
include('../incl/config.php');

// Check if the search query and category are received
if(isset($_POST['query']) && isset($_POST['category'])){
    $search_query = $_POST['query'];
    $category = $_POST['category'];

    // SQL query to fetch filtered product data based on search query and category
    $sql = "SELECT * FROM products WHERE `products` LIKE '%$search_query%'";
    
    // Check if category is selected
    if ($category != '') {
        $sql .= " AND `cat_id` = '$category'";
    }

    // Execute the query
    $result = $conn->query($sql);

    $products = array();

    // Fetch associative array of products
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    }

    // Return product data as JSON
    header('Content-Type: application/json');
    echo json_encode($products);
} else {
    // If search query or category is not received
    echo "No search query or category received.";
}

// Close connection
$conn->close();
?>
