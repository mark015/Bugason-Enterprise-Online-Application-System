<?php
include('../incl/config.php');
// Prepare the SQL statement
$order_id=$_GET['order_id'];
$client_id = '1'; // Change this to the client_id you want to filter by
$sql = "SELECT c.name, c.address, c.contact, o.total_price,o.order_id, o.order_date, o.order_status FROM `order` as o inner join users as c on o.client_id=c.user_id where o.order_id='$order_id'";

// Execute the SQL statement
$result = $conn->query($sql);

// Define labels for each field
$labels = array(
    'name' => 'Name',
    'address' => 'Address',
    'contact' => 'Contact #',
    'total_price' => 'Total Price',
    'order_id' => 'Order Id',
    'order_date' => 'Order Date',
    'order_status' => 'Order Status'
);
// Fetch the results into an associative array with labels
$orders = array();
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $orderWithLabels = array();
        foreach ($row as $key => $value) {
            $orderWithLabels[] = array(
                'label' => $labels[$key],
                'value' => $value
            );
        }
        $orders[] = $orderWithLabels;
    }
}

// Close connection
$conn->close();

// Return the orders as JSON
header('Content-Type: application/json');
echo json_encode($orders);
?>
