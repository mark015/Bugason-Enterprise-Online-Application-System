<?php

include('../incl/config.php');

// Assuming $userId is provided somehow, possibly through a GET or POST request
$userId = $_GET['userId']; // Example: $_GET['userId']

// Prepare and execute the SQL query to fetch user details
$sql = "SELECT `user_id`, `name`, `address`, `contact`, `username`, `password`, `role` FROM `users` WHERE user_id='$userId'";
$result = $conn->query($sql);

// Check if user exists
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    // Return the user details as JSON
    echo json_encode($user);
} else {
    // User not found
    echo json_encode(array('error' => 'User not found'));
}

// Close connection
$conn->close();
?>
