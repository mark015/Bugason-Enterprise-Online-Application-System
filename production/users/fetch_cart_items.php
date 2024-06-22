<?php
// Assuming you have already established a database connection
include('../incl/config.php');
session_start();
$userId=$_SESSION['user_id'];
// SQL query to select data from the shopping_cart table
$order_id = $_POST['order_id'];

$sql = "SELECT img, SC.cart_id as ci, P.products as pro, P.price as pri, SC.cart_quantity as cq, P.price * SC.cart_quantity as total  FROM
`shopping_cart` as SC inner join products as P on SC.product_id = P.products_id where SC.client_id='$userId' && order_id='$order_id'";
// Execute the SQL query
$result = $conn->query($sql);
// Check if any rows were returned
if ($result->num_rows > 0) {
    // Define an empty array to store the fetched data
    $cartItems = array();

    // Fetch data from each row and store it in the cartItems array
    while ($row = $result->fetch_assoc()) {
        $cartItems[] = $row;
    }

    // Return the cart items as JSON
    header('Content-Type: application/json');
    echo json_encode($cartItems);
} else {
    // No rows found in the database
    echo "No cart items found.";
}

// Close the database connection
$conn->close();
?>
