<?php
// Connect to your database
include('../incl/config.php');
session_start();
$user_id=$_SESSION['user_id'];
// Fetch data from the shopping_cart table
$sql = "SELECT img, SC.cart_id as ci, P.products as pro, P.price as pri, SC.cart_quantity as cq, P.price * SC.cart_quantity as total  FROM
 `shopping_cart` as SC inner join products as P on SC.product_id = P.products_id where SC.client_id='$user_id' && SC.status=''";
$result = $conn->query($sql);

// Prepare an array to hold the fetched data
$data = array();

if ($result->num_rows > 0) {
    // Fetch each row from the result set
    while($row = $result->fetch_assoc()) {
        // Add each row to the $data array
        $data[] = $row;
    }
}

// Close the database connection
$conn->close();

// Convert the $data array to JSON and echo it
echo json_encode($data);
?>
