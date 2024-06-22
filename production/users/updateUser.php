<?php
include('../incl/config.php'); 

// Retrieve data from POST request
session_start();
$userId = $_SESSION['user_id'];
$name = $_POST['name'];
$address = $_POST['address'];
$contact = $_POST['contact'];
$username = $_POST['username'];
$password = md5($_POST['password']); // Hashing the password for security

// SQL query to update values
$sql = "UPDATE `users` 
        SET `name` = ?, `address` = ?, `contact` = ?, `username` = ?, `password` = ?
        WHERE `user_id` = ?";

// Prepare statement
$stmt = $conn->prepare($sql);

// Bind parameters
$stmt->bind_param("sssssi", $name, $address, $contact, $username, $password, $userId);



// Execute statement
if ($stmt->execute()) {
    echo 'success';
} else {
    echo 'error: ' . $conn->error;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
