<?php
// Include your database connection or any necessary configuration files
include('../config.php');


// Check if the order_id is set and not empty
if(isset($_POST['order_id']) && !empty($_POST['order_id'])) {
    // Sanitize the input to prevent SQL injection
    $order_id = mysqli_real_escape_string($conn, $_POST['order_id']);
    $status = $_POST['status'];
    // Update the status of the order in the database
    if($status === 'Pending'){
        $sql = "UPDATE `order` SET `order_status` = 'Preparing Order' WHERE `order_id` = '$order_id'";
    }else if($status === 'Preparing Order'){
        $sql = "UPDATE `order` SET `order_status` = 'On Delivery' WHERE `order_id` = '$order_id'";
    }else{
        $sql = "UPDATE `order` SET `order_status` = 'Products Receive' WHERE `order_id` = '$order_id'";
    }
    
    
    if(mysqli_query($conn, $sql)) {
        // If the query is successful, return a success message
        echo json_encode(array('status' => 'success'));
    } else {
        // If there's an error, return an error message
        echo json_encode(array('status' => 'error', 'message' => 'Failed to update status.'));
    }
} else {
    // If order_id is not set or empty, return an error message
    echo json_encode(array('status' => 'error', 'message' => 'Invalid order ID.'));
}

// Close database connection
mysqli_close($conn);
?>
