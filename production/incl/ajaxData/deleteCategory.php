<?php
// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the 'id' parameter is set
include('../config.php');
    if (isset($_POST["id"])) {
        // Extract the id parameter from the POST request
        $categoryId = $_POST["id"];
        // Prepare and execute the SQL delete statement
        $stmt = $conn->prepare("DELETE FROM categories WHERE cat_id = ?");
        $stmt->bind_param("i", $categoryId);
        
        if ($stmt->execute()) {
            // If deletion is successful, return a success message
            echo "Category deleted successfully";
        } else {
            // If deletion fails, return an error message
            echo "Error deleting category: " . $conn->error;
        }
        
        // Close the database connection
        $stmt->close();
        $conn->close();
    } else {
        // If 'id' parameter is missing, return an error message
        echo "Missing parameters";
    }
} else {
    // If request method is not POST, return an error message
    echo "Invalid request method";
}
?>
