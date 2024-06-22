<?php
// Your database connection code goes here

include('../config.php');
// Assuming you have a table named 'users'
$sql = "SELECT COUNT(*) AS user_count FROM users where `role`!='admin'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);


$sqlP = "SELECT COUNT(*) AS product_count FROM products";
$resultP = mysqli_query($conn, $sqlP);
$rowP = mysqli_fetch_assoc($resultP);

$sqlO = "SELECT COUNT(*) AS order_count FROM `order`";
$resultO = mysqli_query($conn, $sqlO);
$rowO = mysqli_fetch_assoc($resultO);

// Prepare JSON response
$response = array(
                    'user_count' => $row['user_count'],
                    'product_count' => $rowP['product_count'],
                    'order_count' => $rowO['order_count']
                );

// Output JSON response
header('Content-Type: application/json');
echo json_encode($response);

// Close database connection
mysqli_close($conn);
?>
