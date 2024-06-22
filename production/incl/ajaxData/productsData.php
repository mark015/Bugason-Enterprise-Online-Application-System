<?php
include('../config.php');
// SQL query to select data from the products table
$sql = "SELECT `products_id`, `category`,`products`, `quantity`, `price`, `img` FROM `products` as p inner join categories as c on p.cat_id=c.cat_id ";

// Execute the query
$result = $conn->query($sql);

// Check if there are any results
if ($result->num_rows > 0) {
    // Array to store product data
    $products = array();
    
    // Fetch data from each row
    while($row = $result->fetch_assoc()) {
        // Push each row as an associative array to the $products array
        $products[] = array(
            'product_id' => $row['products_id'],
            'product_name' => $row['products'],
            'category' => $row['category'],
            'quantity_in_stock' => $row['quantity'],
            'price' => $row['price'],
            'img' => $row['img']
        );
    }
    // Convert the array to JSON format
    $json_data = json_encode($products);
    
    // Output the JSON data
    header('Content-Type: application/json');
    echo $json_data;
} else {
    // No results
    echo json_encode(array('message' => 'No products found'));
}

// Close connection
$conn->close();
?>
