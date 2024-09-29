<?php
// pieChart.php

header('Content-Type: application/json');
include('../config.php');
// Define the query
$query = '
    SELECT count(SC.order_id) as total, U.name 
FROM `order` as SC 
INNER JOIN users as U 
ON SC.client_id = U.user_id 
GROUP BY SC.client_id
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