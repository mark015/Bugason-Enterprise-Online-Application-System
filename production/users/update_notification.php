<?php
// Include database configuration
include('../incl/config.php');

// Check if the user ID is received
if(isset($_GET['user_id'])){
    $user_id = $_GET['user_id'];

    // SQL query to update the status of notifications for the user
    $sql = "UPDATE `order` SET notif_status = '' WHERE client_id = ? AND notif_status = 'unread'";

    // Prepare the statement
    if($stmt = $conn->prepare($sql)){
        // Bind the user_id parameter to the SQL query
        $stmt->bind_param('i', $user_id);

        // Execute the statement
        if($stmt->execute()){
            // Check how many rows were updated
            $affected_rows = $stmt->affected_rows;
            
            // Return a success response
            echo json_encode([
                'success' => true,
                'message' => $affected_rows . ' notifications updated to read.'
            ]);
        } else {
            // Return an error response if execution fails
            echo json_encode([
                'success' => false,
                'message' => 'Failed to update notifications.'
            ]);
        }

        // Close the statement
        $stmt->close();
    } else {
        // Return an error response if statement preparation fails
        echo json_encode([
            'success' => false,
            'message' => 'Failed to prepare SQL statement.'
        ]);
    }
} else {
    // Return an error response if user ID is not received
    echo json_encode([
        'success' => false,
        'message' => 'User ID not received.'
    ]);
}

// Close the connection
$conn->close();
?>
