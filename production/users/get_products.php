<?php
// Include database configuration
include('../incl/config.php');

// Prepare response array
$response = array();

if(isset($_POST['query']) && isset($_POST['category'])){
    $search_query = $_POST['query'];
    $category = $_POST['category'];

    // Prepare SQL query
    $sql = "SELECT * FROM products WHERE `products` LIKE ?";

    // If a category is selected and it's not "all", add it to the query
    if ($category != '' && $category != 'all') {
        $sql .= " AND `cat_id` = ?";
    }

    // Prepare and bind the statement
    if ($stmt = $conn->prepare($sql)) {
        if ($category != '' && $category != 'all') {
            $search_query = "%$search_query%";
            $stmt->bind_param('ss', $search_query, $category);
        } else {
            $search_query = "%$search_query%";
            $stmt->bind_param('s', $search_query);
        }

        // Execute the statement
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Fetch associative array of products
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $response[] = $row;
            }
        }

        // Close statement
        $stmt->close();
    } else {
        $response['error'] = "Failed to prepare the statement.";
    }

    // Return product data as JSON
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // If search query or category is not received
    $response['error'] = "No search query or category received.";
    header('Content-Type: application/json');
    echo json_encode($response);
}

// Close connection
$conn->close();
?>
