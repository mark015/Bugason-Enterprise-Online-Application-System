<?php
// Include database configuration
include('../incl/config.php');

// Check if POST data is received
if(isset($_POST['client_id']) && isset($_POST['product_id']) && isset($_POST['date_add']) && isset($_POST['status']) && isset($_POST['order_status'])){
    // Extract POST data
    $currentDate = date('Y-m-d');
    $client_id = $_POST['client_id'];
    $product_id = $_POST['product_id'];
    $date_add = $_POST['date_add'];
    $status = $_POST['status'];
    $order_status = $_POST['order_status'];
    $cart_quantity = $_POST['cart_quantity'];

    // SQL query to insert into shopping_cart table
    $sql = "INSERT INTO `shopping_cart` (`client_id`, `product_id`, `cart_quantity`, `date_add`, `status`, `order_status`) VALUES ('$client_id', '$product_id', $cart_quantity, '$currentDate', '$status', '$order_status')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        $response = array('success' => true, 'message' => 'Data inserted successfully');
        echo json_encode($response);
    } else {
        $response = array('success' => false, 'message' => 'Error inserting data: ' . $conn->error);
        echo json_encode($response);
    }
} else {
    $response = array('success' => false, 'message' => 'Missing POST data');
    echo json_encode($response);
}

// Close connection
$conn->close();
?>
