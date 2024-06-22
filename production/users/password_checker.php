<?php
// Include your database connection file

include('../incl/config.php');

// Get the username and password sent from the client-side
$userId = $_POST['userId'];
$password = $_POST['password'];
$passwordMd = md5($password);

// Prepare and execute the SQL query to check if the password matches the user in the database
$sql = "SELECT COUNT(*) AS count FROM users WHERE user_id = '$userId' AND password = '$passwordMd'";
$result = $conn->query($sql);

// Check if the password matches the user
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $correct = $row['count'] > 0;
    echo json_encode(['correct' => $correct]);
} else {
    // Error handling
    echo json_encode(['error' => 'Unable to execute query']);
}

// Close connection
$conn->close();
?>
