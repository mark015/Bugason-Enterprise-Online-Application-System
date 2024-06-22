<?php
include('../config.php');
// SQL query to select data from the products table
$sql = "SELECT `order_id`, `name`,`address`,`contact`, `order_date`, `order_status`, `total_price` FROM `order` as o inner JOIN users as u on o.client_id=u.user_id";

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
            'order_id' => $row['order_id'],
            'name' => $row['name'],
            'address' => $row['address'],
            'contact' => $row['contact'],
            'order_date' => $row['order_date'],
            'order_status' => $row['order_status'],
            'total_price' => $row['total_price']
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
