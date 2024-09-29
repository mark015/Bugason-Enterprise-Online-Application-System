<?php
// pieChart.php

header('Content-Type: application/json');
include('../config.php');
// Define the query
$query = '
SELECT sum(cart_quantity) as total, products as name FROM `shopping_cart` as SC INNER  JOIN products as P on SC.product_id=P.products_id WHERE status="Done" group by product_id
ORDER BY total DESC 
LIMIT 10;
';
// Execute the query
$result = $conn->query($query);

// Check if the query was successful
if ($result) {
    $clients = [];
    
    // Fetch the results and store them in an array
    while ($row = $result->fetch_assoc()) {
        $clients[] = [
            'name' => $row['name'],
            'progress' => $row['total'] // Use count as progress (adjust if needed)
        ];
    }
    
    // Output the data in JSON format
    echo json_encode($clients);
} else {
    // If the query fails, return an error message
    echo json_encode(['error' => $conn->error]);
}

// Close the database connection
$conn->close();
?>