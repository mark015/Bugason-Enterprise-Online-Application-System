<?php
// Your database connection code goes here

include('../config.php');

// SQL query to sum total prices and format month names
$sql = "SELECT SUM(total_price) AS order_amount, DATE_FORMAT(`order_date`, '%M') AS order_month FROM `order` GROUP BY MONTH(`order_date`)";
$result = $conn->query($sql);

// Initialize an empty array to store data for the chart
$data = array();

// Process query result and format data for the chart
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = array(
            'order_month' => $row['order_month'],
            'order_amount' => $row['order_amount']
        );
    }
}

// Close database connection
$conn->close();

// Output data in JSON format
header('Content-Type: application/json');
echo json_encode($data);
?>
