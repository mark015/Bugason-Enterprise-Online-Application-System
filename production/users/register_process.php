<?php
include('../incl/config.php'); 
$name = $_POST['name'];
$address = $_POST['address'];
$contact = $_POST['contact'];
$username = $_POST['username'];
$password = md5($_POST['password']); // Hashing the password for security
$role = 'user'; // Assuming 'user' is the default role for new users

// SQL query to insert values
$sql = "INSERT INTO `users`( `name`, `address`, `contact`, `username`, `password`, `role`) 
        VALUES (?, ?, ?, ?, ?, ?)";

// Prepare statement
$stmt = $conn->prepare($sql);

// Bind parameters
$stmt->bind_param("ssssss", $name, $address, $contact, $username, $password, $role);

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