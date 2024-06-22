<?php
// Assuming you have already connected to your database

include('../incl/config.php');
if (isset($_POST['cat_id'])) {
    $currentDateTime = date("Y-m-d");

    $cat_ids = $_POST['cat_id'];
    $response = array();
    session_start();
    $user_id = $_SESSION['user_id'];


SelectTotalPrice($conn, $cat_ids);
    
    $totalPrice = $row['total'];
    $order_status = 'Pending';
    $client_id = '1';
//insert order
$sqlInsertOrder = "INSERT INTO `order` (`client_id`, `order_date`, `order_status`, `total_price`) 
        VALUES ('$user_id', '$currentDateTime', '$order_status' , '$totalPrice')";

// Execute the SQL statement
if ($conn->query($sqlInsertOrder) === TRUE) {
    // Retrieve the auto-generated order_id
    $last_insert_id = $conn->insert_id;

    updateShoppingCart($cat_ids, $last_insert_id, $conn, $user_id);
    
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
echo json_encode(['success' => true]);

} else {
    echo json_encode(['totalP' =>'0']);
}

function SelectTotalPrice($conn, $cat_ids){
    global $row;
    $sql = "SELECT SUM(P.price * SC.cart_quantity) AS total 
    FROM `shopping_cart` as SC 
    INNER JOIN `products` as P 
    ON SC.product_id = P.products_id 
    WHERE SC.cart_id IN (".implode(',', $cat_ids).")";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
}

function updateShoppingCart($cat_ids, $last_insert_id, $conn, $user_id){
    foreach ($cat_ids as $value) {

        viewShoppingCart($conn, $value, $user_id);
        $sqlUpdate = "UPDATE `shopping_cart` SET `order_id`='$last_insert_id' where cart_id='$value'";
        if ($conn->query($sqlUpdate) === TRUE) {
            
        } else {
            
        }
    }
}

function viewShoppingCart($conn, $value, $user_id){
    $sql = "Select product_id, cart_quantity from shopping_cart where cart_id='$value'";
    $result = mysqli_query($conn, $sql);
    $rowView = mysqli_fetch_assoc($result);
    updateQuantity($conn, $rowView, $user_id);
}

function updateQuantity($conn, $rowView, $user_id){

    $sqlUpdateQ = "UPDATE `products` SET `quantity` = `quantity` - " . $rowView['cart_quantity'] . " WHERE `products_id` = '" . $rowView['product_id'] . "'";
    if ($conn->query($sqlUpdateQ) === TRUE) {
        updateShoppingCarts($conn, $user_id);
    } else {
        
    }
}

function updateShoppingCarts($conn, $user_id){
        $sqlUpdate = "UPDATE `shopping_cart` SET `status`='Done' where client_id='$user_id'";
        if ($conn->query($sqlUpdate) === TRUE) {
            
        } else {
            
        }
}
?>
