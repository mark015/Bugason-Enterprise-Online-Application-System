<?php
// Include database configuration
include('../config.php');

// Initialize data array
$data = array();

// Attempt database connection
try {
    // SQL query to fetch order count grouped by order status
    $sql = "SELECT COUNT(*) AS order_count, order_status FROM `order` GROUP BY order_status";
    $result = $conn->query($sql);

    // Process query result and format data for the bar chart
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $data[] = array(
                'category' => $row['order_status'],
                'value' => intval($row['order_count']) // Convert value to integer
            );
        }
    }
} catch (Exception $e) {
    // Handle database connection or query errors
    $error_message = $e->getMessage();
    $data['error'] = "Error fetching data: " . $error_message;
}

// Close database connection
$conn->close();

// Output data in JSON format
header('Content-Type: application/json');
echo json_encode($data);
?>