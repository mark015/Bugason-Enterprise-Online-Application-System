<?php
// Include your database connection or any necessary configuration files
include('../incl/config.php');


// Check if the order_id is set and not empty
if(isset($_POST['orderId']) && !empty($_POST['orderId'])) {
    // Sanitize the input to prevent SQL injection
    $order_id = mysqli_real_escape_string($conn, $_POST['orderId']);
    $value = $_POST['value'];

    if($value === 'Cancel'){
        $sql = "UPDATE `order` SET `order_status` = 'Cancel Order' WHERE `order_id` = '$order_id'";

    }else{
        $sql = "UPDATE `order` SET `order_status` = 'Receve Order' WHERE `order_id` = '$order_id'";
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
    echo json_encode(array('status' => 'error', 'message' => $_POST['order_id']));
}

// Close database connection
mysqli_close($conn);
?>
