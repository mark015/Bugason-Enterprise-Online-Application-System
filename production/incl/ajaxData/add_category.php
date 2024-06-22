<?php
// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the 'categoryName' parameter is set
    if (isset($_POST["categoryName"])) {
        // Extract the categoryName parameter from the POST request
        
include('../config.php');
        $categoryName = $_POST["categoryName"];
       
        
        // Prepare and execute the SQL insert statement
        $stmt = $conn->prepare("INSERT INTO categories (category) VALUES (?)");
        $stmt->bind_param("s", $categoryName);
        
        if ($stmt->execute()) {
            // If insertion is successful, return a success message
            echo "Category added successfully";
        } else {
            // If insertion fails, return an error message
            echo "Error adding category: " . $conn->error;
        }
        
        // Close the database connection
        $stmt->close();
        $conn->close();
    } else {
        // If 'categoryName' parameter is missing, return an error message
        echo "Missing parameters";
    }
} else {
    // If request method is not POST, return an error message
    echo "Invalid request method";
}
?>
