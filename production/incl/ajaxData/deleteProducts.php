<?php
// Check if the ID parameter is set and not empty
if(isset($_POST['id']) && !empty($_POST['id'])) {
    // Include your database connection configuration
    include('../config.php');

    // Sanitize the ID parameter to prevent SQL injection
    $id = mysqli_real_escape_string($conn, $_POST['id']); 

    // SQL query to delete the product with the specified ID
    $sql = "DELETE FROM products WHERE products_id = '$id'";

    // Execute the deletion query
    if(mysqli_query($conn, $sql)) {
        // Deletion successful
        echo json_encode(array('status' => 'success', 'message' => 'Product deleted successfully.'));
    } else {
        // Deletion failed
        echo json_encode(array('status' => 'error', 'message' => 'Error deleting product.'));
    }

    // Close database connection
    mysqli_close($conn);
} else {
    // ID parameter not set or empty
    echo json_encode(array('status' => 'error', 'message' => 'Invalid request.'));
}
?>
