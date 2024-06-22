<?php
// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
include('../config.php');
    // Check if the 'id' and 'name' parameters are set
    if (isset($_POST["id"]) && isset($_POST["name"])) {
        // Extract the id and name parameters from the POST request
        $categoryId = $_POST["id"];
        $categoryName = $_POST["name"];
        
        
        // Prepare and execute the SQL update statement
        $stmt = $conn->prepare("UPDATE categories SET category = ? WHERE cat_id = ?");
        $stmt->bind_param("si", $categoryName, $categoryId);
        
        if ($stmt->execute()) {
            // If update is successful, return a success message
            echo "Category updated successfully";
        } else {
            // If update fails, return an error message
            echo "Error updating category: " . $conn->error;
        }
        
        // Close the database connection
        $stmt->close();
        $conn->close();
    } else {
        // If 'id' or 'name' parameters are missing, return an error message
        echo "Missing parameters";
    }
} else {
    // If request method is not POST, return an error message
    echo "Invalid request method";
}
?>
